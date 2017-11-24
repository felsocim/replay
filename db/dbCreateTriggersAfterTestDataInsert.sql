CREATE OR REPLACE TRIGGER DroitsDiffusion
  BEFORE INSERT
  ON video
  FOR EACH ROW
  DECLARE
    dateLaPlusRecente INTEGER;
  BEGIN
    dateLaPlusRecente := :new.DateValidite - SYSDATE;
    IF dateLaPlusRecente < 7
    THEN
      RAISE_APPLICATION_ERROR(-20101, 'Les droits de diffusion doivent être valable au moins 7 jours!');
    END IF;
  END;
  /

CREATE OR REPLACE TRIGGER EviterDiffusionRetrospective
  BEFORE INSERT
  ON diffusion
  FOR EACH ROW
  BEGIN
    IF :new.DateDiffusion < sysdate
    THEN
      RAISE_APPLICATION_ERROR(-20105, 'La date de diffusion que vous avez indiquée se situe dans le passé!');
    END IF;
  END;
  /

CREATE OR REPLACE TRIGGER PreventionSpam
  BEFORE INSERT OR UPDATE
  ON historique
  FOR EACH ROW
  DECLARE
    nbrVisionnagesParMinute INTEGER:=0;
  BEGIN
    FOR item IN (
      SELECT DateVisionnage
      FROM historique
      WHERE IdUtilisateur = :new.IdUtilisateur
      ORDER BY DateVisionnage DESC
      ) LOOP
      IF (sysdate - item.DateVisionnage)*86400 < 60
      THEN
        nbrVisionnagesParMinute := nbrVisionnagesParMinute + 1;
      END IF;
    END LOOP;
    IF nbrVisionnagesParMinute >= 3
    THEN
      RAISE_APPLICATION_ERROR(-20103, 'Vous avez dépassé le nombre autorisé de visionnages par minute!');
    END IF;
  END;
  /