--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7
-- Dumped by pg_dump version 10.7

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: agendalocal; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA agendalocal;


ALTER SCHEMA agendalocal OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: anuncios; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.anuncios (
    id_anuncio integer NOT NULL,
    id_cidade integer NOT NULL,
    nome character varying(255) NOT NULL,
    tipo character varying(255) NOT NULL,
    expira_em date NOT NULL
);


ALTER TABLE agendalocal.anuncios OWNER TO postgres;

--
-- Name: anuncios_id_anuncio_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.anuncios_id_anuncio_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.anuncios_id_anuncio_seq OWNER TO postgres;

--
-- Name: anuncios_id_anuncio_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.anuncios_id_anuncio_seq OWNED BY agendalocal.anuncios.id_anuncio;


--
-- Name: atividades; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.atividades (
    id integer NOT NULL,
    nome text NOT NULL,
    codigo text NOT NULL
);


ALTER TABLE agendalocal.atividades OWNER TO postgres;

--
-- Name: atividades_id_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.atividades_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.atividades_id_seq OWNER TO postgres;

--
-- Name: atividades_id_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.atividades_id_seq OWNED BY agendalocal.atividades.id;


--
-- Name: cidades; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.cidades (
    id_cidade integer NOT NULL,
    id_estado integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.cidades OWNER TO postgres;

--
-- Name: cidades_id_cidade_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.cidades_id_cidade_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.cidades_id_cidade_seq OWNER TO postgres;

--
-- Name: cidades_id_cidade_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.cidades_id_cidade_seq OWNED BY agendalocal.cidades.id_cidade;


--
-- Name: clientes; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.clientes (
    id_cliente integer NOT NULL,
    id_cidade integer NOT NULL,
    id_tiporegistro integer NOT NULL,
    nome character varying(255) NOT NULL,
    telefone character varying(255) NOT NULL,
    endereco character varying(255) NOT NULL,
    numero character varying(255) NOT NULL,
    atividade character varying(255),
    is_cliente integer NOT NULL,
    logomarca character varying(512),
    whatsapp text,
    site text,
    tipo text,
    estrelas integer,
    score integer
);


ALTER TABLE agendalocal.clientes OWNER TO postgres;

--
-- Name: clientes_id_cliente_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.clientes_id_cliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.clientes_id_cliente_seq OWNER TO postgres;

--
-- Name: clientes_id_cliente_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.clientes_id_cliente_seq OWNED BY agendalocal.clientes.id_cliente;


--
-- Name: estados; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.estados (
    id_estado integer NOT NULL,
    nome character varying(255) NOT NULL,
    sigla character varying(2) NOT NULL
);


ALTER TABLE agendalocal.estados OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.estados_id_estado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.estados_id_estado_seq OWNER TO postgres;

--
-- Name: estados_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.estados_id_estado_seq OWNED BY agendalocal.estados.id_estado;


--
-- Name: inscricoes; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.inscricoes (
    nome text,
    telefone text,
    cep text,
    endereco text,
    cpf text,
    logomarca text,
    plano text,
    email text,
    senha text,
    atividade text,
    spagamento text,
    "dataCadastro" text,
    id integer NOT NULL
);


ALTER TABLE agendalocal.inscricoes OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.inscricoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.inscricoes_id_seq OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.inscricoes_id_seq OWNED BY agendalocal.inscricoes.id;


--
-- Name: niveis_acesso; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.niveis_acesso (
    id_nivelacesso integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.niveis_acesso OWNER TO postgres;

--
-- Name: niveis_acesso_id_nivelacesso_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.niveis_acesso_id_nivelacesso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.niveis_acesso_id_nivelacesso_seq OWNER TO postgres;

--
-- Name: niveis_acesso_id_nivelacesso_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.niveis_acesso_id_nivelacesso_seq OWNED BY agendalocal.niveis_acesso.id_nivelacesso;


--
-- Name: planos; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.planos (
    id integer NOT NULL,
    plano1link text,
    plano2link text,
    plano1valor text,
    plano2valor text
);


ALTER TABLE agendalocal.planos OWNER TO postgres;

--
-- Name: tipos_registro; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.tipos_registro (
    id_tiporegistro integer NOT NULL,
    nome character varying(255) NOT NULL
);


ALTER TABLE agendalocal.tipos_registro OWNER TO postgres;

--
-- Name: tipos_registro_id_tiporegistro_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.tipos_registro_id_tiporegistro_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.tipos_registro_id_tiporegistro_seq OWNER TO postgres;

--
-- Name: tipos_registro_id_tiporegistro_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.tipos_registro_id_tiporegistro_seq OWNED BY agendalocal.tipos_registro.id_tiporegistro;


--
-- Name: usuarios; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.usuarios (
    id_usuario integer NOT NULL,
    id_nivelacesso integer NOT NULL,
    pnome character varying(255) NOT NULL,
    snome character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    login character varying(255) NOT NULL,
    senha character varying(255) NOT NULL
);


ALTER TABLE agendalocal.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal.usuarios_id_usuario_seq OWNER TO postgres;

--
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal.usuarios_id_usuario_seq OWNED BY agendalocal.usuarios.id_usuario;


--
-- Name: versao_lista; Type: TABLE; Schema: agendalocal; Owner: postgres
--

CREATE TABLE agendalocal.versao_lista (
    id integer NOT NULL,
    versao integer
);


ALTER TABLE agendalocal.versao_lista OWNER TO postgres;

--
-- Name: versaoLista_id_seq; Type: SEQUENCE; Schema: agendalocal; Owner: postgres
--

CREATE SEQUENCE agendalocal."versaoLista_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE agendalocal."versaoLista_id_seq" OWNER TO postgres;

--
-- Name: versaoLista_id_seq; Type: SEQUENCE OWNED BY; Schema: agendalocal; Owner: postgres
--

ALTER SEQUENCE agendalocal."versaoLista_id_seq" OWNED BY agendalocal.versao_lista.id;


--
-- Name: anuncios id_anuncio; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios ALTER COLUMN id_anuncio SET DEFAULT nextval('agendalocal.anuncios_id_anuncio_seq'::regclass);


--
-- Name: atividades id; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.atividades ALTER COLUMN id SET DEFAULT nextval('agendalocal.atividades_id_seq'::regclass);


--
-- Name: cidades id_cidade; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades ALTER COLUMN id_cidade SET DEFAULT nextval('agendalocal.cidades_id_cidade_seq'::regclass);


--
-- Name: clientes id_cliente; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes ALTER COLUMN id_cliente SET DEFAULT nextval('agendalocal.clientes_id_cliente_seq'::regclass);


--
-- Name: estados id_estado; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.estados ALTER COLUMN id_estado SET DEFAULT nextval('agendalocal.estados_id_estado_seq'::regclass);


--
-- Name: inscricoes id; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.inscricoes ALTER COLUMN id SET DEFAULT nextval('agendalocal.inscricoes_id_seq'::regclass);


--
-- Name: niveis_acesso id_nivelacesso; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.niveis_acesso ALTER COLUMN id_nivelacesso SET DEFAULT nextval('agendalocal.niveis_acesso_id_nivelacesso_seq'::regclass);


--
-- Name: tipos_registro id_tiporegistro; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.tipos_registro ALTER COLUMN id_tiporegistro SET DEFAULT nextval('agendalocal.tipos_registro_id_tiporegistro_seq'::regclass);


--
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('agendalocal.usuarios_id_usuario_seq'::regclass);


--
-- Name: versao_lista id; Type: DEFAULT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.versao_lista ALTER COLUMN id SET DEFAULT nextval('agendalocal."versaoLista_id_seq"'::regclass);


--
-- Name: anuncios anuncios_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios
    ADD CONSTRAINT anuncios_pkey PRIMARY KEY (id_anuncio);


--
-- Name: atividades atividades_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.atividades
    ADD CONSTRAINT atividades_pkey PRIMARY KEY (id);


--
-- Name: cidades cidades_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades
    ADD CONSTRAINT cidades_pkey PRIMARY KEY (id_cidade);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente);


--
-- Name: estados estados_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id_estado);


--
-- Name: niveis_acesso niveis_acesso_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.niveis_acesso
    ADD CONSTRAINT niveis_acesso_pkey PRIMARY KEY (id_nivelacesso);


--
-- Name: planos planos_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.planos
    ADD CONSTRAINT planos_pkey PRIMARY KEY (id);


--
-- Name: tipos_registro tipos_registro_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.tipos_registro
    ADD CONSTRAINT tipos_registro_pkey PRIMARY KEY (id_tiporegistro);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- Name: versao_lista versaoLista_pkey; Type: CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.versao_lista
    ADD CONSTRAINT "versaoLista_pkey" PRIMARY KEY (id);


--
-- Name: anuncios anuncios_id_cidade_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.anuncios
    ADD CONSTRAINT anuncios_id_cidade_fkey FOREIGN KEY (id_cidade) REFERENCES agendalocal.cidades(id_cidade);


--
-- Name: cidades cidades_id_estado_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.cidades
    ADD CONSTRAINT cidades_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES agendalocal.estados(id_estado);


--
-- Name: clientes clientes_id_cidade_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_id_cidade_fkey FOREIGN KEY (id_cidade) REFERENCES agendalocal.cidades(id_cidade);


--
-- Name: clientes clientes_id_tiporegistro_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.clientes
    ADD CONSTRAINT clientes_id_tiporegistro_fkey FOREIGN KEY (id_tiporegistro) REFERENCES agendalocal.tipos_registro(id_tiporegistro);


--
-- Name: usuarios usuarios_id_nivelacesso_fkey; Type: FK CONSTRAINT; Schema: agendalocal; Owner: postgres
--

ALTER TABLE ONLY agendalocal.usuarios
    ADD CONSTRAINT usuarios_id_nivelacesso_fkey FOREIGN KEY (id_nivelacesso) REFERENCES agendalocal.niveis_acesso(id_nivelacesso);


--
-- PostgreSQL database dump complete
--

