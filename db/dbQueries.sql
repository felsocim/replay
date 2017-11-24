/*Requete 1*/
SELECT c.Titre, COUNT(h.IdVideo) AS visionnages FROM categorie c LEFT JOIN historique h ON c.IdCategorie IN (SELECT IdCategorie FROM emission WHERE IdEmission IN (SELECT IdEmission FROM video WHERE IdVideo=h.IdVideo)) AND ( sysdate - h.DateVisionnage ) < 14 GROUP BY c.Titre;

/*Requete 2*/
SELECT u.Identifiant, COUNT(DISTINCT a.IdEmission) AS abonnements, COUNT(DISTINCT f.IdVideo) AS favoris, COUNT(DISTINCT h.IdVideo) AS visionnages FROM utilisateur u LEFT JOIN abonnement a ON u.IdUtilisateur=a.IdUtilisateur LEFT JOIN favoris f ON u.IdUtilisateur=f.IdUtilisateur LEFT JOIN historique h ON u.IdUtilisateur=h.IdUtilisateur GROUP BY u.Identifiant;

/*Requete 3*/
SELECT v.Titre, COUNT(h1.IdVideo) AS allemagne, COUNT(h2.IdVideo) AS france, ABS(COUNT(h1.IdVideo) - COUNT(h2.IdVideo)) AS difference
FROM video v LEFT JOIN historique h1 ON v.IdVideo IN (SELECT IdVideo FROM video WHERE IdVideo=h1.IdVideo) AND h1.IdUtilisateur
IN (SELECT IdUtilisateur FROM utilisateur WHERE Nationalite='DE') LEFT JOIN historique h2 ON v.IdVideo IN
(SELECT IdVideo FROM video WHERE IdVideo=h2.IdVideo) AND h2.IdUtilisateur IN (SELECT IdUtilisateur FROM utilisateur WHERE Nationalite='FR')
GROUP BY v.Titre ORDER BY difference;

/*Requete 4*/
SELECT DISTINCT e.Titre AS emission, v.Titre AS episode, v.NbrVisionnages AS vues FROM emission e, video v, episode p WHERE e.IdEmission=v.IdEmission AND v.IdVideo=p.IdVideo AND ( v.NbrVisionnages >= (SELECT AVG(NbrVisionnages) FROM video WHERE IdEmission=v.IdEmission AND IdVideo!=v.IdVideo) * 2);

/*Requete 5*/
SELECT v1, v2 FROM (SELECT DISTINCT COUNT(*) AS Nombre, GREATEST(h1.IdVideo, h2.IdVideo) AS v1, LEAST(h1.IdVideo, h2.IdVideo) AS v2 FROM historique h1, historique h2 WHERE h1.IdUtilisateur=h2.IdUtilisateur AND h1.IdVideo!=h2.IdVideo GROUP BY h1.IdVideo, h2.IdVideo ORDER BY Nombre DESC) WHERE ROWNUM <= 10;
