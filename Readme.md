**README**

*Ver 4 Beta 1 - 01-09-2014*

This beta is the last version of MySQL.

The new version Beta 2 will run in PostgreSQL 9.4 Beta3 ONLY.

Finally Postgres comunity has made a impresionant job with the JSONB. We have some versions of Dédalo with the new schema of "Matrix" (id, parent, dato, tipo, lang) in MySQL than run very very slowly. We are working in the new format the last 4 years and the Beta 1 of Dédalo can run acceptably well. Dédalo have some caches for run the searchers but this version don't work "fine" with a large amount of data >100.000 rows (>100.000 interviews, or >100.000 heritage goods...).

But

Postgres with JSONB run ~1000 times faster!!!! and the GIN index have very good optimization for the new schema model of Dédalo.

We think that the new model is a future for Dédalo, and with PostgreSQL 9.4 is possible!!!!

We are very exited with the new JSONB and are expectant and waiting VODKA!

If you need install the beta 1, we recomended MySQL 5.6 and PHP 5.5.

For Intangible Heritage with the Render model (standar schema) for the IPCE you will need install Memcache or Redis.

For the Oral History no is necessary Memcache or Redis.

If you have more than 100.000 records. We recomended wait to the beta 2 (very, very soon)


