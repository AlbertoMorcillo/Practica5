# Practica5

Cosas en tener en cuenta:

-El Oauth2.0 del Github no funciona del todo. Te deja entrar para autorizarte y loguearte pero al querer hacer el callback te sale un error 404. No he encontrado solución.
-En la base de datos tengo puesto que la password es algo que no puedo estar nulo. Por lo tanto, cuando registraba el usuario por hybridoauth con Google, añadía una contraseña default. Podría haber hecho que la contraseña pudiese ser Null. Funcionaría igualmente bien. No lo hice porque creo que no creo que en una empresa fuera una buena idea poner que la contraseña pudiese ser nullo.
-Hay código comentado. El código comentado hay una pequeña explicación del porque esta así. Pero en resumen es porque es código que para implementarlo tenia que solucionar algo antes (en el caso del Oauth2.0). En otros casos es código que podría funcionar o que funcionaba pero de otra forma.
-Por último, me hubiera hecho ilusión conseguir arreglar el oauth2.0 con github pero no he podido. He intentado seguir varios tutoriales pero al final no me funcionaban, o chocaban muchísimo con mí código y básicamente era casí empezar de 0. Por falta de tiempo lo he tenido que dejar así.
