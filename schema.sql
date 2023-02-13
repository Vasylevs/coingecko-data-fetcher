--
-- PostgreSQL database dump
--

-- Dumped from database version 11.18 (Ubuntu 11.18-1.pgdg18.04+1)
-- Dumped by pg_dump version 14.6 (Ubuntu 14.6-0ubuntu0.22.04.1)

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

--
-- Name: coin_price; Type: TABLE; Schema: public; Owner: mrecumcj
--

CREATE TABLE public.coin_price (
    id uuid DEFAULT public.uuid_generate_v4() NOT NULL,
    coin_id character varying(100) NOT NULL,
    coin_symbol character varying(100) NOT NULL,
    currencies character varying(5) NOT NULL,
    price numeric NOT NULL,
    created_at timestamp with time zone DEFAULT now()
);


ALTER TABLE public.coin_price OWNER TO mrecumcj;

--
-- Data for Name: coin_price; Type: TABLE DATA; Schema: public; Owner: mrecumcj
--

COPY public.coin_price (id, coin_id, coin_symbol, currencies, price, created_at) FROM stdin;
e1a3a85c-f528-473e-a776-82da5877e338	bitcoin	BTC	usd	21843	2023-02-13 08:36:05.32929+00
59e2d33e-95de-48db-8881-c1e024fe80a3	bitcoin	BTC	eur	20458	2023-02-13 08:36:05.698313+00
b35cb614-c86e-4177-b5ac-a313efbb6d59	bitcoin	BTC	pln	97875	2023-02-13 08:36:06.078261+00
244440b3-5b19-41be-ba31-a57f969a8bd8	ethereum	ETH	usd	1518.630000	2023-02-13 08:36:06.414337+00
f9995aae-3f33-4968-9464-3f1a8b1eea0c	ethereum-wormhole	ETH	usd	1496.320000	2023-02-13 08:36:06.746809+00
9afd16fc-718e-4522-b6ee-11c34a9d5a0e	monero	XMR	usd	161.170000	2023-02-13 08:36:07.0023+00
ad66bacd-2ed7-4d96-ae1a-ad5e82eb2514	bitcoin	BTC	usd	21848	2023-02-13 08:38:32.230998+00
fcd32970-0068-49ab-b72c-295c5b133637	bitcoin	BTC	eur	20463	2023-02-13 08:38:32.64225+00
d9f65676-a212-490a-8141-d5e084d646ec	bitcoin	BTC	pln	97897	2023-02-13 08:38:32.94807+00
26434b74-76f4-45b9-ab37-2c1e51c59edb	ethereum	ETH	usd	1518.840000	2023-02-13 08:38:33.277007+00
679359a5-aff9-44b6-bf75-01b28ae03f86	ethereum-wormhole	ETH	usd	1502.630000	2023-02-13 08:38:33.665954+00
c1b68856-21c9-4f82-8444-8731541b18a5	monero	XMR	usd	161.300000	2023-02-13 08:38:33.940182+00
fab88e35-bde5-4c08-bee1-0025239a1e31	bitcoin	BTC	usd	21609	2023-02-13 11:19:18.630297+00
b42ef88a-d3ff-4959-9520-bcb085d8cfa1	bitcoin	BTC	eur	20231	2023-02-13 11:19:19.040411+00
ffaaea2a-f7a6-4d19-b615-cd35939ef13c	bitcoin	BTC	pln	96866	2023-02-13 11:19:19.371314+00
fb9633fd-c8d5-4c46-9c89-073bdbb70cbf	ethereum	ETH	usd	1483.990000	2023-02-13 11:19:19.62521+00
3aa1f75b-8e7e-4b73-8d20-49b09c10d4a9	ethereum-wormhole	ETH	usd	1480.240000	2023-02-13 11:19:19.879256+00
b57813d3-6316-49e6-8bf8-9c41f986edd0	monero	XMR	usd	160.380000	2023-02-13 11:19:20.166365+00
\.


--
-- Name: coin_price coin_price_pkey; Type: CONSTRAINT; Schema: public; Owner: mrecumcj
--

ALTER TABLE ONLY public.coin_price
    ADD CONSTRAINT coin_price_pkey PRIMARY KEY (id);


--
-- Name: coin_id; Type: INDEX; Schema: public; Owner: mrecumcj
--

CREATE INDEX coin_id ON public.coin_price USING btree (coin_id);


--
-- Name: coin_id_currencies; Type: INDEX; Schema: public; Owner: mrecumcj
--

CREATE INDEX coin_id_currencies ON public.coin_price USING btree (coin_id, currencies);


--
-- Name: coin_symbol; Type: INDEX; Schema: public; Owner: mrecumcj
--

CREATE INDEX coin_symbol ON public.coin_price USING btree (coin_symbol);


--
-- Name: created_at; Type: INDEX; Schema: public; Owner: mrecumcj
--

CREATE INDEX created_at ON public.coin_price USING btree (created_at);


--
-- PostgreSQL database dump complete
--

