select * from episode;

insert into episode values (epi.nextval, 78, 68, 22);

select * from CATEGORIE;

select * from EMISSION;

select * from UTILISATEUR;

select * from HISTORIQUE;

select * from FAVORIS;

delete from CATEGORIE where IDCATEGORIE=6;

select * from DIFFUSION ORDER BY IDVIDEO;

select * from video;

delete from video where IDVIDEO=7;

insert into video values (vid.nextval, 22, 'essai', 'essai', 23, TO_DATE('07/11/2016', 'DD/MM/YYYY'), 'France', TO_DATE('15/11/2016', 'DD/MM/YYYY'), DEFAULT);

delete from emission where IDEMISSION=22;

select * from VARCHIVE;

INSERT INTO diffusion VALUES (dif.nextval, 7, TO_DATE('08/11/2016', 'DD/MM/YYYY'));

BEGIN genererNEpisodes(TO_DATE('08/11/2016','DD/MM/YYYY'), TO_DATE('05/12/2016', 'DD/MM/YYYY'), 3 ); END;

BEGIN GENERERNEWSLETTER(); END;

BEGIN VIDEOSPOPULAIRES(2); END;

insert into HISTORIQUE VALUES (3, 22, SYSDATE);
