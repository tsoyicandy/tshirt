--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

-- Started on 2025-06-09 00:00:30

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 231 (class 1259 OID 25133)
-- Name: admin; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    email character varying(100) NOT NULL,
    mot_de_passe character varying(100) NOT NULL
);


ALTER TABLE public.admin OWNER TO anonyme;

--
-- TOC entry 230 (class 1259 OID 25132)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_id_admin_seq OWNER TO anonyme;

--
-- TOC entry 4883 (class 0 OID 0)
-- Dependencies: 230
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 228 (class 1259 OID 24979)
-- Name: categories; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.categories (
    id_categorie integer NOT NULL,
    nom character varying(100) NOT NULL
);


ALTER TABLE public.categories OWNER TO anonyme;

--
-- TOC entry 227 (class 1259 OID 24978)
-- Name: categories_id_categorie_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.categories_id_categorie_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_categorie_seq OWNER TO anonyme;

--
-- TOC entry 4884 (class 0 OID 0)
-- Dependencies: 227
-- Name: categories_id_categorie_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.categories_id_categorie_seq OWNED BY public.categories.id_categorie;


--
-- TOC entry 218 (class 1259 OID 24910)
-- Name: clients; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.clients (
    id_client integer NOT NULL,
    nom character varying(100) NOT NULL,
    email character varying(150) NOT NULL,
    telephone character varying(20),
    date_inscription date DEFAULT CURRENT_DATE,
    motdepasse text DEFAULT 'test123'::text NOT NULL
);


ALTER TABLE public.clients OWNER TO anonyme;

--
-- TOC entry 217 (class 1259 OID 24909)
-- Name: clients_id_client_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.clients_id_client_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.clients_id_client_seq OWNER TO anonyme;

--
-- TOC entry 4885 (class 0 OID 0)
-- Dependencies: 217
-- Name: clients_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.clients_id_client_seq OWNED BY public.clients.id_client;


--
-- TOC entry 224 (class 1259 OID 24941)
-- Name: commandes; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.commandes (
    id_commande integer NOT NULL,
    id_client integer,
    date_commande timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    statut character varying(50) DEFAULT 'en attente'::character varying
);


ALTER TABLE public.commandes OWNER TO anonyme;

--
-- TOC entry 223 (class 1259 OID 24940)
-- Name: commandes_id_commande_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.commandes_id_commande_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.commandes_id_commande_seq OWNER TO anonyme;

--
-- TOC entry 4886 (class 0 OID 0)
-- Dependencies: 223
-- Name: commandes_id_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.commandes_id_commande_seq OWNED BY public.commandes.id_commande;


--
-- TOC entry 226 (class 1259 OID 24955)
-- Name: details_commande; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.details_commande (
    id_detail integer NOT NULL,
    id_commande integer,
    id_tshirt integer,
    id_taille integer,
    quantite integer,
    prix_unitaire numeric(10,2),
    CONSTRAINT details_commande_prix_unitaire_check CHECK ((prix_unitaire >= (0)::numeric)),
    CONSTRAINT details_commande_quantite_check CHECK ((quantite > 0))
);


ALTER TABLE public.details_commande OWNER TO anonyme;

--
-- TOC entry 225 (class 1259 OID 24954)
-- Name: details_commande_id_detail_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.details_commande_id_detail_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.details_commande_id_detail_seq OWNER TO anonyme;

--
-- TOC entry 4887 (class 0 OID 0)
-- Dependencies: 225
-- Name: details_commande_id_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.details_commande_id_detail_seq OWNED BY public.details_commande.id_detail;


--
-- TOC entry 220 (class 1259 OID 24920)
-- Name: tailles; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.tailles (
    id_taille integer NOT NULL,
    libelle character varying(10) NOT NULL
);


ALTER TABLE public.tailles OWNER TO anonyme;

--
-- TOC entry 219 (class 1259 OID 24919)
-- Name: tailles_id_taille_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.tailles_id_taille_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tailles_id_taille_seq OWNER TO anonyme;

--
-- TOC entry 4888 (class 0 OID 0)
-- Dependencies: 219
-- Name: tailles_id_taille_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.tailles_id_taille_seq OWNED BY public.tailles.id_taille;


--
-- TOC entry 222 (class 1259 OID 24929)
-- Name: tshirts; Type: TABLE; Schema: public; Owner: anonyme
--

CREATE TABLE public.tshirts (
    id_tshirt integer NOT NULL,
    nom character varying(100) NOT NULL,
    description text,
    prix numeric(10,2) NOT NULL,
    couleur character varying(50),
    stock integer DEFAULT 0,
    id_categorie integer,
    image character varying(255),
    CONSTRAINT tshirts_prix_check CHECK ((prix >= (0)::numeric)),
    CONSTRAINT tshirts_stock_check CHECK ((stock >= 0))
);


ALTER TABLE public.tshirts OWNER TO anonyme;

--
-- TOC entry 221 (class 1259 OID 24928)
-- Name: tshirts_id_tshirt_seq; Type: SEQUENCE; Schema: public; Owner: anonyme
--

CREATE SEQUENCE public.tshirts_id_tshirt_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tshirts_id_tshirt_seq OWNER TO anonyme;

--
-- TOC entry 4889 (class 0 OID 0)
-- Dependencies: 221
-- Name: tshirts_id_tshirt_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anonyme
--

ALTER SEQUENCE public.tshirts_id_tshirt_seq OWNED BY public.tshirts.id_tshirt;


--
-- TOC entry 229 (class 1259 OID 24992)
-- Name: v_tshirts_par_categorie; Type: VIEW; Schema: public; Owner: anonyme
--

CREATE VIEW public.v_tshirts_par_categorie AS
 SELECT t.id_tshirt,
    t.nom AS nom_tshirt,
    t.description,
    t.prix,
    t.couleur,
    t.stock,
    t.image,
    c.nom AS categorie
   FROM (public.tshirts t
     LEFT JOIN public.categories c ON ((t.id_categorie = c.id_categorie)));


ALTER VIEW public.v_tshirts_par_categorie OWNER TO anonyme;

--
-- TOC entry 4686 (class 2604 OID 25136)
-- Name: admin id_admin; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);


--
-- TOC entry 4685 (class 2604 OID 24982)
-- Name: categories id_categorie; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.categories ALTER COLUMN id_categorie SET DEFAULT nextval('public.categories_id_categorie_seq'::regclass);


--
-- TOC entry 4675 (class 2604 OID 24913)
-- Name: clients id_client; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.clients ALTER COLUMN id_client SET DEFAULT nextval('public.clients_id_client_seq'::regclass);


--
-- TOC entry 4681 (class 2604 OID 24944)
-- Name: commandes id_commande; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commandes ALTER COLUMN id_commande SET DEFAULT nextval('public.commandes_id_commande_seq'::regclass);


--
-- TOC entry 4684 (class 2604 OID 24958)
-- Name: details_commande id_detail; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.details_commande ALTER COLUMN id_detail SET DEFAULT nextval('public.details_commande_id_detail_seq'::regclass);


--
-- TOC entry 4678 (class 2604 OID 24923)
-- Name: tailles id_taille; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tailles ALTER COLUMN id_taille SET DEFAULT nextval('public.tailles_id_taille_seq'::regclass);


--
-- TOC entry 4679 (class 2604 OID 24932)
-- Name: tshirts id_tshirt; Type: DEFAULT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tshirts ALTER COLUMN id_tshirt SET DEFAULT nextval('public.tshirts_id_tshirt_seq'::regclass);


--
-- TOC entry 4877 (class 0 OID 25133)
-- Dependencies: 231
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.admin (id_admin, email, mot_de_passe) FROM stdin;
1	admin@site.com	admin123
\.


--
-- TOC entry 4875 (class 0 OID 24979)
-- Dependencies: 228
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.categories (id_categorie, nom) FROM stdin;
1	Geek
2	Nature
3	Minimaliste
4	Sport
5	Humour
\.


--
-- TOC entry 4865 (class 0 OID 24910)
-- Dependencies: 218
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.clients (id_client, nom, email, telephone, date_inscription, motdepasse) FROM stdin;
1	Alice Dupont	alice@example.com	0612345678	2025-06-07	test123
2	Bob Martin	bob@example.com	0698765432	2025-06-07	test123
\.


--
-- TOC entry 4871 (class 0 OID 24941)
-- Dependencies: 224
-- Data for Name: commandes; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.commandes (id_commande, id_client, date_commande, statut) FROM stdin;
1	1	2025-06-07 08:42:26.578918	en attente
2	2	2025-06-08 00:00:00	validee
3	2	2025-06-08 00:00:00	validee
4	2	2025-06-08 00:00:00	validee
5	2	2025-06-08 00:00:00	validee
6	2	2025-06-08 00:00:00	validee
\.


--
-- TOC entry 4873 (class 0 OID 24955)
-- Dependencies: 226
-- Data for Name: details_commande; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.details_commande (id_detail, id_commande, id_tshirt, id_taille, quantite, prix_unitaire) FROM stdin;
1	1	1	3	2	19.90
2	1	2	2	1	17.50
4	2	14	1	1	20.00
5	2	7	1	1	20.00
6	2	26	1	1	20.00
8	3	26	1	1	20.00
9	3	14	1	1	20.00
10	4	24	1	1	19.00
11	5	24	1	1	19.00
12	6	24	1	1	19.00
\.


--
-- TOC entry 4867 (class 0 OID 24920)
-- Dependencies: 220
-- Data for Name: tailles; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.tailles (id_taille, libelle) FROM stdin;
1	S
2	M
3	L
4	XL
\.


--
-- TOC entry 4869 (class 0 OID 24929)
-- Dependencies: 222
-- Data for Name: tshirts; Type: TABLE DATA; Schema: public; Owner: anonyme
--

COPY public.tshirts (id_tshirt, nom, description, prix, couleur, stock, id_categorie, image) FROM stdin;
4	T-Shirt Pac-Man	Design rétro inspiré de Pac-Man	19.90	Noir	25	1	/static/images/geek1.jpg
5	T-Shirt Space Invaders	Motif pixel art	18.90	Gris	20	1	/static/images/geek2.jpg
6	T-Shirt Zelda	Logo doré Triforce	22.00	Vert	15	1	/static/images/geek3.jpg
7	T-Shirt Mario	Super Mario Bros classique	20.00	Rouge	18	1	/static/images/geek4.jpg
8	T-Shirt Python Dev	Pour les fans de programmation	21.00	Bleu	12	1	/static/images/geek5.jpg
9	T-Shirt Blanc Uni	Simple et élégant	15.00	Blanc	40	2	/static/images/min1.jpg
10	T-Shirt Noir Logo	Petit logo discret	16.00	Noir	35	2	/static/images/min2.jpg
11	T-Shirt Pastel Rose	Couleurs douces	17.50	Rose	30	2	/static/images/min3.jpg
12	T-Shirt Ligne Fine	Design épuré minimaliste	18.00	Gris clair	22	2	/static/images/min4.jpg
13	T-Shirt Zen	Ambiance calme et apaisée	19.00	Beige	26	2	/static/images/min5.jpg
14	T-Shirt Arbre de Vie	Motif arbre enraciné	20.00	Vert forêt	15	3	/static/images/nature1.jpg
15	T-Shirt Feuilles	Imprimé feuillage tropical	19.50	Vert clair	18	3	/static/images/nature2.jpg
16	T-Shirt Montagne	Paysage naturel en sérigraphie	21.00	Bleu glacier	20	3	/static/images/nature3.jpg
17	T-Shirt Éco-Friendly	Coton bio, message écolo	22.00	Blanc	25	3	/static/images/nature4.jpg
18	T-Shirt Soleil	Soleil couchant artistique	20.90	Orange doux	16	3	/static/images/nature5.jpg
19	T-Shirt Running Pro	Respirant pour la course	25.00	Noir	20	4	/static/images/sport1.jpg
20	T-Shirt Gym Squad	Parfait pour la salle de sport	23.50	Gris	22	4	/static/images/sport2.jpg
21	T-Shirt Football	Style maillot léger	24.00	Bleu	18	4	/static/images/sport3.jpg
22	T-Shirt Yoga Flow	Souple et doux	22.50	Lavande	15	4	/static/images/sport4.jpg
23	T-Shirt Cycliste	Coupe sport ajustée	26.00	Rouge vif	12	4	/static/images/sport5.jpg
24	T-Shirt Blague Dev	Je code donc je suis (bugué)	19.00	Gris	30	5	/static/images/humour1.jpg
25	T-Shirt Sarcastique	Ironie 100% coton	18.50	Noir	28	5	/static/images/humour2.jpg
26	T-Shirt "Je peux pas"	…raclette	20.00	Blanc	32	5	/static/images/humour3.jpg
27	T-Shirt Citation Marrante	"Ce t-shirt me va bien"	19.90	Bleu	20	5	/static/images/humour4.jpg
28	T-Shirt Puni	Écrit 100 fois "Je ne ferai plus de bug"	21.00	Rouge	18	5	/static/images/humour5.jpg
2	T-shirt Nature	T-shirt vert avec motif feuille	17.50	Vert	30	2	/static/images/nature.jpg
1	T-shirt Geek	T-shirt noir avec impression pixel art	19.90	Noir	50	1	/static/images/geek.jpg
\.


--
-- TOC entry 4890 (class 0 OID 0)
-- Dependencies: 230
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 1, true);


--
-- TOC entry 4891 (class 0 OID 0)
-- Dependencies: 227
-- Name: categories_id_categorie_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.categories_id_categorie_seq', 5, true);


--
-- TOC entry 4892 (class 0 OID 0)
-- Dependencies: 217
-- Name: clients_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.clients_id_client_seq', 2, true);


--
-- TOC entry 4893 (class 0 OID 0)
-- Dependencies: 223
-- Name: commandes_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.commandes_id_commande_seq', 6, true);


--
-- TOC entry 4894 (class 0 OID 0)
-- Dependencies: 225
-- Name: details_commande_id_detail_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.details_commande_id_detail_seq', 12, true);


--
-- TOC entry 4895 (class 0 OID 0)
-- Dependencies: 219
-- Name: tailles_id_taille_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.tailles_id_taille_seq', 4, true);


--
-- TOC entry 4896 (class 0 OID 0)
-- Dependencies: 221
-- Name: tshirts_id_tshirt_seq; Type: SEQUENCE SET; Schema: public; Owner: anonyme
--

SELECT pg_catalog.setval('public.tshirts_id_tshirt_seq', 29, true);


--
-- TOC entry 4710 (class 2606 OID 25140)
-- Name: admin admin_email_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_email_key UNIQUE (email);


--
-- TOC entry 4712 (class 2606 OID 25138)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 4706 (class 2606 OID 24986)
-- Name: categories categories_nom_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_nom_key UNIQUE (nom);


--
-- TOC entry 4708 (class 2606 OID 24984)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id_categorie);


--
-- TOC entry 4692 (class 2606 OID 24918)
-- Name: clients clients_email_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_email_key UNIQUE (email);


--
-- TOC entry 4694 (class 2606 OID 24916)
-- Name: clients clients_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id_client);


--
-- TOC entry 4702 (class 2606 OID 24948)
-- Name: commandes commandes_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 4704 (class 2606 OID 24962)
-- Name: details_commande details_commande_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_pkey PRIMARY KEY (id_detail);


--
-- TOC entry 4696 (class 2606 OID 24927)
-- Name: tailles tailles_libelle_key; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tailles
    ADD CONSTRAINT tailles_libelle_key UNIQUE (libelle);


--
-- TOC entry 4698 (class 2606 OID 24925)
-- Name: tailles tailles_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tailles
    ADD CONSTRAINT tailles_pkey PRIMARY KEY (id_taille);


--
-- TOC entry 4700 (class 2606 OID 24939)
-- Name: tshirts tshirts_pkey; Type: CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tshirts
    ADD CONSTRAINT tshirts_pkey PRIMARY KEY (id_tshirt);


--
-- TOC entry 4714 (class 2606 OID 24949)
-- Name: commandes commandes_id_client_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.commandes
    ADD CONSTRAINT commandes_id_client_fkey FOREIGN KEY (id_client) REFERENCES public.clients(id_client) ON DELETE CASCADE;


--
-- TOC entry 4715 (class 2606 OID 24963)
-- Name: details_commande details_commande_id_commande_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_id_commande_fkey FOREIGN KEY (id_commande) REFERENCES public.commandes(id_commande) ON DELETE CASCADE;


--
-- TOC entry 4716 (class 2606 OID 24973)
-- Name: details_commande details_commande_id_taille_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_id_taille_fkey FOREIGN KEY (id_taille) REFERENCES public.tailles(id_taille);


--
-- TOC entry 4717 (class 2606 OID 24968)
-- Name: details_commande details_commande_id_tshirt_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.details_commande
    ADD CONSTRAINT details_commande_id_tshirt_fkey FOREIGN KEY (id_tshirt) REFERENCES public.tshirts(id_tshirt);


--
-- TOC entry 4713 (class 2606 OID 24987)
-- Name: tshirts fk_tshirt_categorie; Type: FK CONSTRAINT; Schema: public; Owner: anonyme
--

ALTER TABLE ONLY public.tshirts
    ADD CONSTRAINT fk_tshirt_categorie FOREIGN KEY (id_categorie) REFERENCES public.categories(id_categorie) ON DELETE SET NULL;


-- Completed on 2025-06-09 00:00:30

--
-- PostgreSQL database dump complete
--

