-- Adminer 4.8.1 PostgreSQL 13.2 (Debian 13.2-1.pgdg100+1) dump

DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."users" (
    "id" bigint DEFAULT nextval('users_id_seq') NOT NULL,
    "username" character varying(50) NOT NULL,
    "email" character varying(100) NOT NULL,
    "password" character varying(255) NOT NULL,
    "created_at" timestamptz DEFAULT now() NOT NULL,
    CONSTRAINT "users_email_key" UNIQUE ("email"),
    CONSTRAINT "users_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "users_username_key" UNIQUE ("username")
) WITH (oids = false);

INSERT INTO "users" ("id", "username", "email", "password", "created_at") VALUES
(1,	'qqqq',	'testing@example.com',	'$2y$10$dioBucz6.AmfDxT/zjJzj.dMwaYkeyj82EgRvRXFVE9j6kHBY/xB2',	'2025-10-15 22:22:42.417313+00'),
(2,	'testngmore',	'test@example.com',	'098f6bcd4621d373cade4e832627b4f6',	'2025-10-15 22:53:15.347797+00');

-- 2025-10-15 22:54:34.204556+00