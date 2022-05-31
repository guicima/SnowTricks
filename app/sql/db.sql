--
-- PostgreSQL database dump
--

-- Dumped from database version 13.7
-- Dumped by pg_dump version 13.6

-- Started on 2022-05-31 18:01:56 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = "heap";

--
-- TOC entry 200 (class 1259 OID 16385)
-- Name: comment; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."comment" (
    "id" integer NOT NULL,
    "user_id_id" integer NOT NULL,
    "trick_id_id" integer NOT NULL,
    "text" character varying(255) NOT NULL,
    "created_at" timestamp(6) without time zone NOT NULL,
    "modified_at" timestamp(6) without time zone NOT NULL
);


ALTER TABLE "public"."comment" OWNER TO "app5468135";

--
-- TOC entry 2274 (class 0 OID 0)
-- Dependencies: 200
-- Name: COLUMN "comment"."created_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."comment"."created_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 2275 (class 0 OID 0)
-- Dependencies: 200
-- Name: COLUMN "comment"."modified_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."comment"."modified_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 201 (class 1259 OID 16388)
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: app5468135
--

CREATE SEQUENCE "public"."comment_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."comment_id_seq" OWNER TO "app5468135";

--
-- TOC entry 202 (class 1259 OID 16390)
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."doctrine_migration_versions" (
    "version" character varying(191) NOT NULL,
    "executed_at" timestamp(6) without time zone DEFAULT NULL::timestamp without time zone,
    "execution_time" integer
);


ALTER TABLE "public"."doctrine_migration_versions" OWNER TO "app5468135";

--
-- TOC entry 203 (class 1259 OID 16394)
-- Name: image; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."image" (
    "id" integer NOT NULL,
    "trick_id" integer NOT NULL,
    "name" character varying(255) NOT NULL,
    "type" character varying(255) NOT NULL
);


ALTER TABLE "public"."image" OWNER TO "app5468135";

--
-- TOC entry 204 (class 1259 OID 16400)
-- Name: image_id_seq; Type: SEQUENCE; Schema: public; Owner: app5468135
--

CREATE SEQUENCE "public"."image_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."image_id_seq" OWNER TO "app5468135";

--
-- TOC entry 205 (class 1259 OID 16402)
-- Name: reset_password_request; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."reset_password_request" (
    "id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "selector" character varying(20) NOT NULL,
    "hashed_token" character varying(100) NOT NULL,
    "requested_at" timestamp(6) without time zone NOT NULL,
    "expires_at" timestamp(6) without time zone NOT NULL
);


ALTER TABLE "public"."reset_password_request" OWNER TO "app5468135";

--
-- TOC entry 2276 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN "reset_password_request"."requested_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."reset_password_request"."requested_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 2277 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN "reset_password_request"."expires_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."reset_password_request"."expires_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 206 (class 1259 OID 16405)
-- Name: reset_password_request_id_seq; Type: SEQUENCE; Schema: public; Owner: app5468135
--

CREATE SEQUENCE "public"."reset_password_request_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."reset_password_request_id_seq" OWNER TO "app5468135";

--
-- TOC entry 207 (class 1259 OID 16407)
-- Name: trick; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."trick" (
    "id" integer NOT NULL,
    "name" character varying(255) NOT NULL,
    "description" "text" NOT NULL,
    "theme" character varying(255) NOT NULL,
    "modified_at" timestamp(6) without time zone NOT NULL,
    "created_at" timestamp(6) without time zone NOT NULL,
    "slug" character varying(255) NOT NULL
);


ALTER TABLE "public"."trick" OWNER TO "app5468135";

--
-- TOC entry 2278 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN "trick"."modified_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."trick"."modified_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 2279 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN "trick"."created_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."trick"."created_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 208 (class 1259 OID 16413)
-- Name: trick_id_seq; Type: SEQUENCE; Schema: public; Owner: app5468135
--

CREATE SEQUENCE "public"."trick_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."trick_id_seq" OWNER TO "app5468135";

--
-- TOC entry 209 (class 1259 OID 16415)
-- Name: user; Type: TABLE; Schema: public; Owner: app5468135
--

CREATE TABLE "public"."user" (
    "id" integer NOT NULL,
    "email" character varying(180) NOT NULL,
    "roles" "json" NOT NULL,
    "password" character varying(255) NOT NULL,
    "is_verified" boolean NOT NULL,
    "username" character varying(255) NOT NULL,
    "image_url" character varying(255) DEFAULT NULL::character varying,
    "modified_at" timestamp(6) without time zone NOT NULL,
    "created_at" timestamp(6) without time zone NOT NULL
);


ALTER TABLE "public"."user" OWNER TO "app5468135";

--
-- TOC entry 2280 (class 0 OID 0)
-- Dependencies: 209
-- Name: COLUMN "user"."modified_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."user"."modified_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 2281 (class 0 OID 0)
-- Dependencies: 209
-- Name: COLUMN "user"."created_at"; Type: COMMENT; Schema: public; Owner: app5468135
--

COMMENT ON COLUMN "public"."user"."created_at" IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 210 (class 1259 OID 16422)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: app5468135
--

CREATE SEQUENCE "public"."user_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "public"."user_id_seq" OWNER TO "app5468135";

--
-- TOC entry 2258 (class 0 OID 16385)
-- Dependencies: 200
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."comment" ("id", "user_id_id", "trick_id_id", "text", "created_at", "modified_at") FROM stdin;
1	1	6	Mon préféré	2022-05-30 18:59:36.370913	2022-05-30 18:59:36.370914
2	2	6	Ps: aujourd'hui on abrevie souvent par juste Cork	2022-05-30 19:06:45.738027	2022-05-30 19:06:45.738028
\.


--
-- TOC entry 2260 (class 0 OID 16390)
-- Dependencies: 202
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."doctrine_migration_versions" ("version", "executed_at", "execution_time") FROM stdin;
DoctrineMigrations\\Version20220530174823	2022-05-30 17:48:36.837682	238
\.


--
-- TOC entry 2261 (class 0 OID 16394)
-- Dependencies: 203
-- Data for Name: image; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."image" ("id", "trick_id", "name", "type") FROM stdin;
\.


--
-- TOC entry 2263 (class 0 OID 16402)
-- Dependencies: 205
-- Data for Name: reset_password_request; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."reset_password_request" ("id", "user_id", "selector", "hashed_token", "requested_at", "expires_at") FROM stdin;
\.


--
-- TOC entry 2265 (class 0 OID 16407)
-- Dependencies: 207
-- Data for Name: trick; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."trick" ("id", "name", "description", "theme", "modified_at", "created_at", "slug") FROM stdin;
1	Grab Indy	Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ». \r\nIndy : saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.	grabs	2022-05-30 18:38:50.689587	2022-05-30 18:38:50.689583	Grab-Indy
2	Tail Grab	Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ».\r\nTail Grab : saisie de la partie arrière de la planche, avec la main arrière.	grabs	2022-05-30 18:40:54.438672	2022-05-30 18:40:54.43867	Tail-Grab
3	Truck Driver	Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. ».\r\ntruck driver: saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).	grabs	2022-05-30 18:42:27.011209	2022-05-30 18:42:27.011207	Truck-Driver
4	180	On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal. un 180 désigne un demi-tour, soit 180 degrés d'angle.	rotation	2022-05-30 18:44:35.764999	2022-05-30 18:44:35.764997	180
5	360	On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal. 360, trois six pour un tour complet.	rotation	2022-05-30 18:45:31.126538	2022-05-30 18:45:31.126536	360
6	Corkscrew	Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu'initialement horizontales, font passer la tête en bas.\r\n\r\nBien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d'autres, il est en théorie possible de d'attérir n'importe quelle rotation désaxée avec n'importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu.\r\n\r\nIl est également possible d'agrémenter une rotation désaxée par un grab.	rotations désaxées	2022-05-30 18:47:48.023148	2022-05-30 18:47:48.023144	Corkscrew
7	Mac Twist	Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.\r\n\r\nIl est possible de faire plusieurs flips à la suite, et d'ajouter un grab à la rotation.\r\n\r\nLes flips agrémentés d'une vrille existent aussi (Mac Twist, Hakon Flip...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.\r\n\r\nNéanmoins, en dépit de la difficulté technique relative d'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.	flips	2022-05-30 18:49:22.482047	2022-05-30 18:49:22.482045	Mac-Twist
8	Japan air	Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school)	old school	2022-05-30 18:50:49.81174	2022-05-30 18:50:49.811739	Japan-air
9	Backside Air	Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school)	old school	2022-05-30 18:51:57.241106	2022-05-30 18:51:57.241105	Backside-Air
10	Big Foot	On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal. 1080 ou big foot désigne trois tours	rotation	2022-05-30 18:55:16.755352	2022-05-30 18:55:16.75535	Big-Foot
\.


--
-- TOC entry 2267 (class 0 OID 16415)
-- Dependencies: 209
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: app5468135
--

COPY "public"."user" ("id", "email", "roles", "password", "is_verified", "username", "image_url", "modified_at", "created_at") FROM stdin;
1	guilherme.cimabatista@gmail.com	["ROLE_USER", "ROLE_ADMIN"]	$2y$13$h4FYSRcjNyTuQLYML1izB.4U5QZtzug9Kb1eMUbOSm0pDNkYJNUMS	f	guicima	\N	2022-05-30 17:51:55.951985	2022-05-30 17:51:55.951982
2	guilherme.c25@gmail.com	["ROLE_USER"]	$2y$13$VP6UY09MIERTD0pKAu9QD.GMun.1MKkHVMv2.84wUwjxuQdQO71Zm	t	jean_marc	\N	2022-05-30 19:02:20.222945	2022-05-30 19:02:20.222941
\.


--
-- TOC entry 2282 (class 0 OID 0)
-- Dependencies: 201
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app5468135
--

SELECT pg_catalog.setval('"public"."comment_id_seq"', 2, true);


--
-- TOC entry 2283 (class 0 OID 0)
-- Dependencies: 204
-- Name: image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app5468135
--

SELECT pg_catalog.setval('"public"."image_id_seq"', 1, false);


--
-- TOC entry 2284 (class 0 OID 0)
-- Dependencies: 206
-- Name: reset_password_request_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app5468135
--

SELECT pg_catalog.setval('"public"."reset_password_request_id_seq"', 1, false);


--
-- TOC entry 2285 (class 0 OID 0)
-- Dependencies: 208
-- Name: trick_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app5468135
--

SELECT pg_catalog.setval('"public"."trick_id_seq"', 10, true);


--
-- TOC entry 2286 (class 0 OID 0)
-- Dependencies: 210
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: app5468135
--

SELECT pg_catalog.setval('"public"."user_id_seq"', 2, true);


--
-- TOC entry 2106 (class 2606 OID 16425)
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."comment"
    ADD CONSTRAINT "comment_pkey" PRIMARY KEY ("id");


--
-- TOC entry 2110 (class 2606 OID 16427)
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."doctrine_migration_versions"
    ADD CONSTRAINT "doctrine_migration_versions_pkey" PRIMARY KEY ("version");


--
-- TOC entry 2113 (class 2606 OID 16429)
-- Name: image image_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."image"
    ADD CONSTRAINT "image_pkey" PRIMARY KEY ("id");


--
-- TOC entry 2116 (class 2606 OID 16431)
-- Name: reset_password_request reset_password_request_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."reset_password_request"
    ADD CONSTRAINT "reset_password_request_pkey" PRIMARY KEY ("id");


--
-- TOC entry 2118 (class 2606 OID 16433)
-- Name: trick trick_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."trick"
    ADD CONSTRAINT "trick_pkey" PRIMARY KEY ("id");


--
-- TOC entry 2123 (class 2606 OID 16435)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."user"
    ADD CONSTRAINT "user_pkey" PRIMARY KEY ("id");


--
-- TOC entry 2114 (class 1259 OID 16436)
-- Name: idx_7ce748aa76ed395; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE INDEX "idx_7ce748aa76ed395" ON "public"."reset_password_request" USING "btree" ("user_id");


--
-- TOC entry 2107 (class 1259 OID 16437)
-- Name: idx_9474526c9d86650f; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE INDEX "idx_9474526c9d86650f" ON "public"."comment" USING "btree" ("user_id_id");


--
-- TOC entry 2108 (class 1259 OID 16438)
-- Name: idx_9474526cb46b9ee8; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE INDEX "idx_9474526cb46b9ee8" ON "public"."comment" USING "btree" ("trick_id_id");


--
-- TOC entry 2111 (class 1259 OID 16439)
-- Name: idx_c53d045fb281be2e; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE INDEX "idx_c53d045fb281be2e" ON "public"."image" USING "btree" ("trick_id");


--
-- TOC entry 2120 (class 1259 OID 16440)
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE UNIQUE INDEX "uniq_8d93d649e7927c74" ON "public"."user" USING "btree" ("email");


--
-- TOC entry 2121 (class 1259 OID 16441)
-- Name: uniq_8d93d649f85e0677; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE UNIQUE INDEX "uniq_8d93d649f85e0677" ON "public"."user" USING "btree" ("username");


--
-- TOC entry 2119 (class 1259 OID 16442)
-- Name: uniq_d8f0a91e5e237e06; Type: INDEX; Schema: public; Owner: app5468135
--

CREATE UNIQUE INDEX "uniq_d8f0a91e5e237e06" ON "public"."trick" USING "btree" ("name");


--
-- TOC entry 2127 (class 2606 OID 16443)
-- Name: reset_password_request fk_7ce748aa76ed395; Type: FK CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."reset_password_request"
    ADD CONSTRAINT "fk_7ce748aa76ed395" FOREIGN KEY ("user_id") REFERENCES "public"."user"("id");


--
-- TOC entry 2124 (class 2606 OID 16448)
-- Name: comment fk_9474526c9d86650f; Type: FK CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."comment"
    ADD CONSTRAINT "fk_9474526c9d86650f" FOREIGN KEY ("user_id_id") REFERENCES "public"."user"("id");


--
-- TOC entry 2125 (class 2606 OID 16453)
-- Name: comment fk_9474526cb46b9ee8; Type: FK CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."comment"
    ADD CONSTRAINT "fk_9474526cb46b9ee8" FOREIGN KEY ("trick_id_id") REFERENCES "public"."trick"("id");


--
-- TOC entry 2126 (class 2606 OID 16458)
-- Name: image fk_c53d045fb281be2e; Type: FK CONSTRAINT; Schema: public; Owner: app5468135
--

ALTER TABLE ONLY "public"."image"
    ADD CONSTRAINT "fk_c53d045fb281be2e" FOREIGN KEY ("trick_id") REFERENCES "public"."trick"("id");


-- Completed on 2022-05-31 18:01:56 UTC

--
-- PostgreSQL database dump complete
--

