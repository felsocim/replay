CREATE OR REPLACE PROCEDURE archivageAutomatique IS
  BEGIN
    INSERT INTO varchive (SELECT * FROM video WHERE DateValidite < sysdate);
    DELETE FROM video WHERE DateValidite < sysdate;
  END;
  /
BEGIN
    DBMS_SCHEDULER.CREATE_JOB(job_name        => 'ARCHIVAGE_AUTOMATIQUE',
                              job_type        => 'STORED_PROCEDURE',
                              job_action      => 'archivageAutomatique',
                              start_date      => systimestamp,
                              end_date        => null,
                              repeat_interval => 'freq=daily; byhour=6; byminute=0; bysecond=0;',
                              enabled         => true,
                              auto_drop       => false,
                              comments        => 'Archive automatiquement les vidéos dont la date de validité vient d''expirer.');
END;
/
CREATE OR REPLACE FUNCTION videoJSON(id IN INTEGER)
  RETURN VARCHAR2 AS json VARCHAR2(5000);
  ligneVideo  video%ROWTYPE;
  BEGIN
    SELECT * INTO ligneVideo FROM video WHERE IdVideo=id;
    json := '{ ' || 'IdVideo: ' || ligneVideo.IdVideo || ', IdEmission: ' || ligneVideo.IdEmission || ', Titre: "' || ligneVideo.Titre || '", Description: "' || ligneVideo.Description || '", Duree: ' || ligneVideo.Duree || ', DatePremiere: ' || ligneVideo.DatePremiere || ', Origine: "' || ligneVideo.Origine || '", DateValidite: ' || ligneVideo.DateValidite || ', NbrVisionnages: ' || ligneVideo.NbrVisionnages || ' }';
    RETURN json;
  END;
  /

CREATE OR REPLACE PROCEDURE genererNewsletter IS
  BEGIN
    DBMS_OUTPUT.PUT_LINE('Cher utilisateur, voici la liste de toutes les sorties de la semaine: ');
    FOR ligneVideo IN (
    SELECT
      v.Titre AS titre,
      v.Description AS description,
      d.DateDiffusion AS dateDiff
    FROM video v, diffusion d
    WHERE v.IdVideo=d.IdVideo AND d.DateDiffusion >= sysdate AND to_char(d.DateDiffusion, 'IW') = to_char(sysdate, 'IW')
    ) LOOP
      DBMS_OUTPUT.PUT_LINE(ligneVideo.titre || ' * ' || ligneVideo.description || ' * Prochaine diffusion : ' || TO_CHAR(ligneVideo.dateDiff, 'DD/MM/YYYY'));
    END LOOP;
  END;
  /

CREATE OR REPLACE PROCEDURE genererNEpisodes(
  dateDebut DATE,
  dateFin DATE,
  emission NUMBER
) IS
    nbrEpisodesAGenerer  INTEGER;
    dureeEmission INTEGER;
    origineEmission VARCHAR2(255);
    numEpisode INTEGER;
  BEGIN
    nbrEpisodesAGenerer := (dateFin - dateDebut) / 7;
    SELECT Duree INTO dureeEmission FROM video WHERE IdEmission=emission AND ROWNUM=1;
    SELECT Origine INTO origineEmission FROM video WHERE IdEmission=emission AND ROWNUM=1;
    SELECT MAX(NumeroEpisode) INTO numEpisode FROM episode WHERE IdEmission=emission;
    IF nbrEpisodesAGenerer > 1
    THEN
      WHILE nbrEpisodesAGenerer > 0
      LOOP
        numEpisode := numEpisode + 1;
        INSERT INTO video VALUES (vid.nextval, emission, 'A venir', 'A venir', dureeEmission, dateDebut+(nbrEpisodesAGenerer-1)*7, origineEmission, (dateDebut+(nbrEpisodesAGenerer-1)*7)+7, DEFAULT);
        INSERT INTO episode VALUES (epi.nextval, numEpisode, vid.currval, emission);
        INSERT INTO diffusion VALUES (dif.nextval, vid.currval, dateDebut+(nbrEpisodesAGenerer-1)*7);
        nbrEpisodesAGenerer := nbrEpisodesAGenerer - 1;
      END LOOP;
    END IF;
  END;
  /

CREATE OR REPLACE PROCEDURE videosPopulaires(
  idU NUMBER
) IS
  BEGIN
    FOR pop IN (
    SELECT
      v.Titre,
      v.Description,
      COUNT(h.IdVideo) AS popularite
    FROM video v, historique h
    WHERE v.IdVideo = h.IdVideo AND (sysdate - h.DateVisionnage) < 14 AND v.IdEmission IN (SELECT IdEmission
                                                                                           FROM emission
                                                                                           WHERE IdCategorie IN
                                                                                                 (SELECT IdCategorie
                                                                                                  FROM preference
                                                                                                  WHERE IdUtilisateur =
                                                                                                        idU))
    GROUP BY v.Titre, v.Description
    ORDER BY popularite DESC
    ) LOOP
      DBMS_OUTPUT.PUT_LINE(pop.Titre || ' * ' || pop.Description || ' * ' || pop.popularite || ' vues.');
    END LOOP;
  END;
  /