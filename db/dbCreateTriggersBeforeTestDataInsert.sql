CREATE OR REPLACE TRIGGER MaximumFavoris
  BEFORE INSERT
  ON favoris
  FOR EACH ROW
  DECLARE
    nombreActuelDeFavoris INTEGER;
  BEGIN
    SELECT COUNT(*) INTO nombreActuelDeFavoris FROM favoris WHERE IdUtilisateur=:new.IdUtilisateur;
    IF nombreActuelDeFavoris >= 300
    THEN
      RAISE_APPLICATION_ERROR(-20102, 'Vous avez dépassé le nombre autorisé de favoris pour cet utilisateur!');
    END IF;
  END;
  /

CREATE OR REPLACE TRIGGER NouvelleDiffusion
  BEFORE INSERT
  ON diffusion
  FOR EACH ROW
  DECLARE
    dateDerniereDiffusion DATE;
    diffusionsPrecedentes INTEGER;
  BEGIN
    SELECT COUNT(*) INTO diffusionsPrecedentes FROM diffusion WHERE IdVideo=:new.IdVideo;
    IF diffusionsPrecedentes > 0
    THEN
      SELECT MAX(DateDiffusion) INTO dateDerniereDiffusion FROM diffusion WHERE IdVideo=:new.IdVideo;
      UPDATE video SET DateValidite=(dateDerniereDiffusion+14) WHERE IdVideo=:new.IdVideo;
    END IF;
  END;
  /

CREATE OR REPLACE TRIGGER SuppressionArchivage
  BEFORE DELETE
  ON video
  FOR EACH ROW
  BEGIN
    INSERT INTO varchive VALUES (:old.IdVideo, :old.IdEmission, :old.Titre, :old.Description, :old.Duree, :old.DatePremiere, :old.Origine, :old.DateValidite, :old.NbrVisionnages);
  END;
  /

CREATE OR REPLACE TRIGGER IncrementerNbrVisionnages
  AFTER INSERT
  ON historique
  FOR EACH ROW
  BEGIN
    UPDATE video SET NbrVisionnages=NbrVisionnages+1 WHERE IdVideo=:new.IdVideo;
  END;
  /

CREATE OR REPLACE TRIGGER eviterDoubleEpisode
  BEFORE INSERT OR UPDATE
  ON episode
  FOR EACH ROW
  DECLARE
    sommeDeControle INTEGER:=0;
  BEGIN
    SELECT COUNT(*) INTO sommeDeControle FROM episode WHERE NumeroEpisode=:new.NumeroEpisode AND IdEmission=:new.IdEmission;
    IF sommeDeControle != 0
    THEN
      RAISE_APPLICATION_ERROR(-20104, 'L''émission ' || :new.IdEmission || ' comporte déjà l''épisode numéro ' || :new.NumeroEpisode || ' !');
    END IF;
  END;
  /