--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: courses; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE courses (
    id integer NOT NULL,
    name character varying,
    course_number integer,
    departments_id integer
);


ALTER TABLE courses OWNER TO "Guest";

--
-- Name: courses_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE courses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE courses_id_seq OWNER TO "Guest";

--
-- Name: courses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE courses_id_seq OWNED BY courses.id;


--
-- Name: courses_majors; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE courses_majors (
    id integer NOT NULL,
    courses_id integer,
    majors_id integer
);


ALTER TABLE courses_majors OWNER TO "Guest";

--
-- Name: courses_majors_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE courses_majors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE courses_majors_id_seq OWNER TO "Guest";

--
-- Name: courses_majors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE courses_majors_id_seq OWNED BY courses_majors.id;


--
-- Name: courses_students; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE courses_students (
    id integer NOT NULL,
    students_id integer,
    courses_id integer,
    completed boolean
);


ALTER TABLE courses_students OWNER TO "Guest";

--
-- Name: courses_students_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE courses_students_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE courses_students_id_seq OWNER TO "Guest";

--
-- Name: courses_students_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE courses_students_id_seq OWNED BY courses_students.id;


--
-- Name: departments; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE departments (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE departments OWNER TO "Guest";

--
-- Name: departments_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE departments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE departments_id_seq OWNER TO "Guest";

--
-- Name: departments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE departments_id_seq OWNED BY departments.id;


--
-- Name: majors; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE majors (
    id integer NOT NULL,
    name character varying,
    departments_id integer
);


ALTER TABLE majors OWNER TO "Guest";

--
-- Name: majors_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE majors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE majors_id_seq OWNER TO "Guest";

--
-- Name: majors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE majors_id_seq OWNED BY majors.id;


--
-- Name: students; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE students (
    id integer NOT NULL,
    name character varying,
    enrollment_date date
);


ALTER TABLE students OWNER TO "Guest";

--
-- Name: students_departments; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE students_departments (
    id integer NOT NULL,
    departments_id integer,
    students_id integer
);


ALTER TABLE students_departments OWNER TO "Guest";

--
-- Name: students_departments_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE students_departments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE students_departments_id_seq OWNER TO "Guest";

--
-- Name: students_departments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE students_departments_id_seq OWNED BY students_departments.id;


--
-- Name: students_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE students_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE students_id_seq OWNER TO "Guest";

--
-- Name: students_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE students_id_seq OWNED BY students.id;


--
-- Name: students_majors; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE students_majors (
    id integer NOT NULL,
    students_id integer,
    majors_id integer
);


ALTER TABLE students_majors OWNER TO "Guest";

--
-- Name: students_majors_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE students_majors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE students_majors_id_seq OWNER TO "Guest";

--
-- Name: students_majors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE students_majors_id_seq OWNED BY students_majors.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY courses ALTER COLUMN id SET DEFAULT nextval('courses_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY courses_majors ALTER COLUMN id SET DEFAULT nextval('courses_majors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY courses_students ALTER COLUMN id SET DEFAULT nextval('courses_students_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY departments ALTER COLUMN id SET DEFAULT nextval('departments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY majors ALTER COLUMN id SET DEFAULT nextval('majors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY students ALTER COLUMN id SET DEFAULT nextval('students_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY students_departments ALTER COLUMN id SET DEFAULT nextval('students_departments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY students_majors ALTER COLUMN id SET DEFAULT nextval('students_majors_id_seq'::regclass);


--
-- Data for Name: courses; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY courses (id, name, course_number, departments_id) FROM stdin;
\.


--
-- Name: courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('courses_id_seq', 712, true);


--
-- Data for Name: courses_majors; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY courses_majors (id, courses_id, majors_id) FROM stdin;
\.


--
-- Name: courses_majors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('courses_majors_id_seq', 1, false);


--
-- Data for Name: courses_students; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY courses_students (id, students_id, courses_id, completed) FROM stdin;
1	44	105	\N
2	45	106	\N
3	46	106	\N
4	52	118	\N
5	53	119	\N
6	54	119	\N
7	60	131	\N
8	61	132	\N
9	62	132	\N
10	68	144	\N
11	69	145	\N
12	70	145	\N
13	76	157	\N
14	77	158	\N
15	78	158	\N
16	84	170	\N
17	85	182	\N
18	86	184	\N
19	87	184	\N
20	88	196	\N
21	89	208	\N
22	90	220	\N
23	91	221	\N
24	92	221	\N
25	98	233	\N
26	99	234	\N
27	100	234	\N
28	106	246	\N
29	107	247	\N
30	108	247	\N
31	114	259	\N
32	115	260	\N
33	116	260	\N
35	123	273	\N
36	124	274	\N
37	125	274	\N
39	132	287	\N
40	133	288	\N
41	134	288	\N
43	141	301	\N
44	142	302	\N
45	143	302	\N
47	150	315	\N
48	151	316	\N
49	152	316	\N
51	159	330	\N
52	160	331	\N
53	161	331	\N
55	168	345	\N
56	169	346	\N
57	170	346	\N
59	177	360	\N
60	178	361	\N
61	179	361	\N
63	186	375	\N
64	187	376	\N
65	188	376	\N
67	195	390	\N
68	196	391	\N
69	197	391	\N
71	204	405	\N
72	205	406	\N
73	206	406	\N
75	213	420	\N
76	214	421	\N
77	215	421	\N
79	222	435	\N
80	223	436	\N
81	224	436	\N
83	231	450	\N
84	232	451	\N
85	233	451	\N
87	240	465	\N
88	241	466	\N
89	242	466	\N
91	249	480	\N
92	250	481	\N
93	251	481	\N
95	258	495	\N
96	259	496	\N
97	260	496	\N
99	267	510	\N
100	268	511	\N
101	269	511	\N
103	276	525	\N
104	277	526	\N
105	278	526	\N
107	288	540	\N
108	289	541	\N
109	290	541	\N
110	292	555	\N
111	293	556	\N
112	294	556	\N
114	295	558	\N
115	304	570	\N
116	305	571	\N
117	306	571	\N
119	307	573	\N
120	316	585	\N
121	317	586	\N
122	318	586	\N
124	319	588	\N
125	328	600	\N
126	329	601	\N
127	330	601	\N
129	331	603	\N
130	340	615	\N
131	341	616	\N
132	342	616	\N
134	343	618	\N
135	352	630	\N
136	353	631	\N
137	354	631	\N
139	355	633	\N
140	364	645	\N
141	365	646	\N
142	366	646	\N
144	367	648	\N
145	376	660	\N
146	377	661	\N
147	378	661	\N
149	379	663	\N
150	388	675	\N
151	389	676	\N
152	390	676	\N
154	391	678	\N
155	400	690	\N
156	401	691	\N
157	402	691	\N
159	403	693	\N
160	413	705	\N
161	414	706	\N
162	415	706	\N
164	416	708	\N
165	428	709	\N
166	429	710	\N
167	429	711	\N
169	431	712	\N
\.


--
-- Name: courses_students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('courses_students_id_seq', 169, true);


--
-- Data for Name: departments; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY departments (id, name) FROM stdin;
\.


--
-- Name: departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('departments_id_seq', 1, false);


--
-- Data for Name: majors; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY majors (id, name, departments_id) FROM stdin;
\.


--
-- Name: majors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('majors_id_seq', 1, false);


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY students (id, name, enrollment_date) FROM stdin;
\.


--
-- Data for Name: students_departments; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY students_departments (id, departments_id, students_id) FROM stdin;
\.


--
-- Name: students_departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('students_departments_id_seq', 1, false);


--
-- Name: students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('students_id_seq', 431, true);


--
-- Data for Name: students_majors; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY students_majors (id, students_id, majors_id) FROM stdin;
\.


--
-- Name: students_majors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('students_majors_id_seq', 1, false);


--
-- Name: courses_majors_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY courses_majors
    ADD CONSTRAINT courses_majors_pkey PRIMARY KEY (id);


--
-- Name: courses_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY courses
    ADD CONSTRAINT courses_pkey PRIMARY KEY (id);


--
-- Name: courses_students_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY courses_students
    ADD CONSTRAINT courses_students_pkey PRIMARY KEY (id);


--
-- Name: departments_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY departments
    ADD CONSTRAINT departments_pkey PRIMARY KEY (id);


--
-- Name: majors_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY majors
    ADD CONSTRAINT majors_pkey PRIMARY KEY (id);


--
-- Name: students_departments_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY students_departments
    ADD CONSTRAINT students_departments_pkey PRIMARY KEY (id);


--
-- Name: students_majors_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY students_majors
    ADD CONSTRAINT students_majors_pkey PRIMARY KEY (id);


--
-- Name: students_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY students
    ADD CONSTRAINT students_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: epicodus
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM epicodus;
GRANT ALL ON SCHEMA public TO epicodus;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

