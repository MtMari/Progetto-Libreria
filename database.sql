-- Adminer 5.4.2 PostgreSQL 16.13 dump

CREATE SEQUENCE "public".autore_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."autore" (
    "id" integer DEFAULT nextval('autore_id_seq') NOT NULL,
    "nome_autore" character varying(25) NOT NULL,
    "cognome_autore" character varying(25) NOT NULL,
    "data_nascita" date,
    "disponibilita" boolean,
    "qualita_scrittura" integer NOT NULL,
    CONSTRAINT "autore_pkey" PRIMARY KEY ("id")
)
WITH (oids = false);

INSERT INTO "autore" ("id", "nome_autore", "cognome_autore", "data_nascita", "disponibilita", "qualita_scrittura") VALUES
(1,	'Nome1',	'Cognome1',	'1951-06-28',	'1',	3),
(2,	'Nome2',	'Cognome2',	'1980-04-30',	'0',	5),
(3,	'Nome3',	'Cognome3',	'1971-05-03',	'0',	1),
(4,	'Nome4',	'Cognome4',	'1962-05-22',	'0',	4),
(5,	'Nome5',	'Cognome5',	'1965-05-28',	'0',	3);

CREATE SEQUENCE "public".autore_libro_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."autore_libro" (
    "id" integer DEFAULT nextval('autore_libro_id_seq') NOT NULL,
    "autore_id" integer,
    "libro_id" integer,
    "extra" character varying(255),
    CONSTRAINT "autore_libro_pkey" PRIMARY KEY ("id")
)
WITH (oids = false);

CREATE INDEX idx_60b76695beceffb6 ON public.autore_libro USING btree (autore_id);

CREATE INDEX idx_60b76695c0238522 ON public.autore_libro USING btree (libro_id);

INSERT INTO "autore_libro" ("id", "autore_id", "libro_id", "extra") VALUES
(1,	3,	1,	NULL),
(2,	4,	2,	NULL),
(3,	1,	2,	NULL),
(4,	2,	3,	NULL),
(5,	2,	4,	NULL),
(7,	4,	4,	NULL),
(6,	5,	4,	NULL);

CREATE TABLE "public"."doctrine_migration_versions" (
    "version" character varying(191) NOT NULL,
    "executed_at" timestamp(0),
    "execution_time" integer,
    CONSTRAINT "doctrine_migration_versions_pkey" PRIMARY KEY ("version")
)
WITH (oids = false);

INSERT INTO "doctrine_migration_versions" ("version", "executed_at", "execution_time") VALUES
('DoctrineMigrations\Version20251111103029',	'2026-03-17 17:23:00',	96),
('DoctrineMigrations\Version20251111111340',	'2026-03-17 17:23:00',	12),
('DoctrineMigrations\Version20251111132347',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251112084946',	'2026-03-17 17:23:01',	6),
('DoctrineMigrations\Version20251112091246',	'2026-03-17 17:23:01',	6),
('DoctrineMigrations\Version20251112091416',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251113080554',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251113091634',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251113093201',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251113151345',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251113151651',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251114093130',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251114102233',	'2026-03-17 17:23:01',	8),
('DoctrineMigrations\Version20251114103213',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251114104001',	'2026-03-17 17:23:01',	11),
('DoctrineMigrations\Version20251114133642',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251114145126',	'2026-03-17 17:23:01',	4),
('DoctrineMigrations\Version20251114145502',	'2026-03-17 17:23:01',	5),
('DoctrineMigrations\Version20251114145942',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251114155504',	'2026-03-17 17:23:01',	5),
('DoctrineMigrations\Version20251117104228',	'2026-03-17 17:23:01',	26),
('DoctrineMigrations\Version20251117105434',	'2026-03-17 17:23:01',	26),
('DoctrineMigrations\Version20251117114002',	'2026-03-17 17:23:01',	14),
('DoctrineMigrations\Version20251117115305',	'2026-03-17 17:23:01',	22),
('DoctrineMigrations\Version20251117130714',	'2026-03-17 17:23:01',	26),
('DoctrineMigrations\Version20251120151334',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251120151607',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251120153029',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251120153150',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251120153543',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251120160321',	'2026-03-17 17:23:01',	0),
('DoctrineMigrations\Version20251126093821',	'2026-03-17 17:23:01',	18),
('DoctrineMigrations\Version20251126100532',	'2026-03-17 17:23:01',	7),
('DoctrineMigrations\Version20251126100902',	'2026-03-17 17:23:01',	2),
('DoctrineMigrations\Version20251126101027',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251126154808',	'2026-03-17 17:23:01',	6),
('DoctrineMigrations\Version20251202103129',	'2026-03-17 17:23:01',	2),
('DoctrineMigrations\Version20251202131811',	'2026-03-17 17:23:01',	1),
('DoctrineMigrations\Version20251204083212',	'2026-03-17 17:23:01',	2),
('DoctrineMigrations\Version20251209095341',	'2026-03-17 17:23:01',	10),
('DoctrineMigrations\Version20251209105940',	'2026-03-17 17:23:01',	3),
('DoctrineMigrations\Version20260317174634',	'2026-03-17 18:47:54',	154);

CREATE SEQUENCE "public".libro_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."libro" (
    "id" integer DEFAULT nextval('libro_id_seq') NOT NULL,
    "titolo" character varying(20) NOT NULL,
    "descrizione" character varying(255),
    "pagine" integer NOT NULL,
    CONSTRAINT "libro_pkey" PRIMARY KEY ("id")
)
WITH (oids = false);

INSERT INTO "libro" ("id", "titolo", "descrizione", "pagine") VALUES
(1,	'Titolo1',	'Descrizione1',	350),
(2,	'Titolo2',	'Descr.',	240),
(3,	'Titolo3',	'Racconto breve',	130),
(4,	'Titolo4',	'Descrizione non disponibile',	380);

CREATE SEQUENCE "public".utente_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."utente" (
    "id" integer DEFAULT nextval('utente_id_seq') NOT NULL,
    "nome_utente" character varying(180) NOT NULL,
    "roles" json NOT NULL,
    "password" character varying(255) NOT NULL,
    "email" character varying(180) NOT NULL,
    CONSTRAINT "utente_pkey" PRIMARY KEY ("id")
)
WITH (oids = false);

CREATE UNIQUE INDEX uniq_identifier_nome_utente ON public.utente USING btree (nome_utente);

CREATE UNIQUE INDEX uniq_identifier_email ON public.utente USING btree (email);

INSERT INTO "utente" ("id", "nome_utente", "roles", "password", "email") VALUES
(2,	'Admin2',	'["ROLE_ADMIN"]',	'$2y$13$6RIFHSe1n0WBY.MSaWilnO1g.lSr2Ipj6gA782Tmd6vB2H2oCRSna',	'admin2@mail.com'),
(3,	'Base1',	'[]',	'$2y$13$/st4rVOp4wTm2py50bSr6ON7pKUPpJ0sn40BU8T4iqUTpjoLmRsrC',	'base1@mail.com');

ALTER TABLE ONLY "public"."autore_libro" ADD CONSTRAINT "fk_60b76695beceffb6" FOREIGN KEY (autore_id) REFERENCES autore(id);
ALTER TABLE ONLY "public"."autore_libro" ADD CONSTRAINT "fk_60b76695c0238522" FOREIGN KEY (libro_id) REFERENCES libro(id);

-- 2026-03-19 13:59:48 UTC
