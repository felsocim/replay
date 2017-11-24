CREATE TABLE categorie (
  IdCategorie  NUMBER(10) NOT NULL,
  Titre VARCHAR2(255)  NOT NULL,
  Description VARCHAR2(4000)  NOT NULL,
  CONSTRAINT pk_categorie PRIMARY KEY (IdCategorie)
);

CREATE SEQUENCE cat
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE emission (
  IdEmission  NUMBER(10) NOT NULL,
  IdCategorie NUMBER(10) NOT NULL,
  Titre VARCHAR2(255)  NOT NULL,
  Description VARCHAR2(4000)  NOT NULL,
  Chaine VARCHAR2(255) NOT NULL,
  CONSTRAINT pk_emission PRIMARY KEY (IdEmission),
  CONSTRAINT fk_emission_categorie FOREIGN KEY (IdCategorie) REFERENCES categorie (IdCategorie) ON DELETE CASCADE
);

CREATE SEQUENCE emi
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE video (
  IdVideo NUMBER(10) NOT NULL,
  IdEmission  NUMBER(10) NOT NULL,
  Titre VARCHAR2(255)  NOT NULL,
  Description VARCHAR2(4000) NOT NULL,
  Duree INTEGER NOT NULL,
  DatePremiere  DATE NOT NULL,
  Origine VARCHAR2(255)  NOT NULL,
  DateValidite  DATE DEFAULT (SYSDATE+7) NOT NULL,
  NbrVisionnages  INTEGER DEFAULT 0,
  CONSTRAINT pk_video PRIMARY KEY (IdVideo),
  CONSTRAINT fk_video_emission FOREIGN KEY (IdEmission) REFERENCES emission (IdEmission) ON DELETE CASCADE
);

CREATE SEQUENCE vid
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE varchive (
  IdVideo NUMBER(10) NOT NULL,
  IdEmission  NUMBER(10) NOT NULL,
  Titre VARCHAR2(255)  NOT NULL,
  Description VARCHAR2(4000) NOT NULL,
  Duree INTEGER NOT NULL,
  DatePremiere  DATE NOT NULL,
  Origine VARCHAR2(255)  NOT NULL,
  DateValidite  DATE NOT NULL,
  NbrVisionnages  INTEGER NOT NULL,
  CONSTRAINT u_varchive UNIQUE (IdVideo)
);

CREATE TABLE diffusion (
  IdDiffusion NUMBER(10) NOT NULL,
  IdVideo NUMBER(10) NOT NULL,
  DateDiffusion DATE NOT NULL,
  CONSTRAINT pk_diffusion PRIMARY KEY (IdDiffusion),
  CONSTRAINT fk_diffusion_video FOREIGN KEY (IdVideo) REFERENCES video (IdVideo) ON DELETE CASCADE
);

CREATE SEQUENCE dif
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE episode (
  IdEpisode NUMBER(10) NOT NULL,
  NumeroEpisode INTEGER NOT NULL,
  IdVideo NUMBER(10) NOT NULL,
  IdEmission  NUMBER(10) NOT NULL,
  CONSTRAINT pk_episode PRIMARY KEY (IdEpisode),
  CONSTRAINT fk_episode_video FOREIGN KEY (IdVideo) REFERENCES video (IdVideo) ON DELETE CASCADE,
  CONSTRAINT fk_episode_emission FOREIGN KEY (IdEmission) REFERENCES emission (IdEmission) ON DELETE CASCADE
);

CREATE SEQUENCE epi
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE utilisateur (
  IdUtilisateur NUMBER(10) NOT NULL,
  Identifiant VARCHAR2(255)  NOT NULL,
  Nom VARCHAR2(255)  NOT NULL,
  Prenom  VARCHAR2(255)  NOT NULL,
  MotDePasse VARCHAR2(255) NOT NULL,
  DateNaissance DATE NOT NULL,
  Courriel  VARCHAR2(255)  NOT NULL,
  DateInscription DATE DEFAULT sysdate NOT NULL,
  DateDerniereConnexion DATE NOT NULL,
  Groupe  CHAR(1) DEFAULT 'U' NOT NULL,
  AbonnementNewsletter  CHAR(1)  DEFAULT 'N' NOT NULL,
  Nationalite VARCHAR2(2)  NOT NULL,
  CONSTRAINT pk_utilisateur PRIMARY KEY (IdUtilisateur),
  CONSTRAINT ch_courriel CHECK ( Courriel LIKE '%@%.%' ),
  CONSTRAINT ch_groupe CHECK (Groupe IN ('U', 'A', 'S')),
  CONSTRAINT ch_abonnement CHECK (AbonnementNewsletter IN ('N', 'Y'))
);

CREATE SEQUENCE uti
  START WITH 1
  INCREMENT BY 1
  CACHE 10;

CREATE TABLE preference (
  IdUtilisateur NUMBER(10) NOT NULL,
  IdCategorie NUMBER(10) NOT NULL,
  CONSTRAINT fk_preference_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES utilisateur (IdUtilisateur) ON DELETE CASCADE,
  CONSTRAINT fk_preference_categorie FOREIGN KEY (IdCategorie) REFERENCES categorie (IdCategorie) ON DELETE CASCADE
);

CREATE TABLE historique (
  IdUtilisateur NUMBER(10) NOT NULL,
  IdVideo NUMBER(10) NOT NULL,
  DateVisionnage  DATE DEFAULT sysdate NOT NULL,
  CONSTRAINT fk_historique_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES utilisateur (IdUtilisateur) ON DELETE CASCADE,
  CONSTRAINT fk_historique_video FOREIGN KEY (IdVideo) REFERENCES video (IdVideo) ON DELETE CASCADE
);

CREATE TABLE favoris (
  IdUtilisateur NUMBER(10) NOT NULL,
  IdVideo NUMBER(10) NOT NULL,
  CONSTRAINT fk_favoris_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES utilisateur (IdUtilisateur) ON DELETE CASCADE,
  CONSTRAINT fk_favoris_video FOREIGN KEY (IdVideo) REFERENCES video (IdVideo) ON DELETE CASCADE
);

CREATE TABLE abonnement (
  IdUtilisateur NUMBER(10) NOT NULL,
  IdEmission  NUMBER(10) NOT NULL,
  CONSTRAINT fk_abonnement_utilisateur FOREIGN KEY (IdUtilisateur) REFERENCES utilisateur (IdUtilisateur) ON DELETE CASCADE,
  CONSTRAINT fk_abonnement_emission FOREIGN KEY (IdEmission) REFERENCES emission (IdEmission) ON DELETE CASCADE
);