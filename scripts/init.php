<?php

require_once __DIR__.'/../vendor/autoload.php';

use Opis\Database\Schema\CreateTable;
use Scripts\DB;

$db = new DB();

$db->createTable('gender', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('mentoring', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('interest', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('dificulty', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('expected_grade', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('assistance', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('students', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->integer('age')->size('normal')->notNull();
    $table->integer('highest_course')->size('normal')->notNull();
    $table->integer('lowest_course')->size('normal')->notNull();
    $table->integer('enrollment')->size('normal')->notNull();
    $table->integer('exam')->size('normal')->notNull();
    $table->primary('id');
    $table->integer('id_gender')->size('normal');
    $table->integer('id_mentoring')->size('normal');
    $table->integer('id_interest')->size('normal');
    $table->integer('id_dificulty')->size('normal');
    $table->integer('id_expected_grade')->size('normal');
    $table->integer('id_assitance')->size('normal');
    $table->foreign('id_gender')->references('gender', 'id');
    $table->foreign('id_mentoring')->references('mentoring', 'id');
    $table->foreign('id_interest')->references('interest', 'id');
    $table->foreign('id_dificulty')->references('dificulty', 'id');
    $table->foreign('id_expected_grade')->references('expected_grade', 'id');
    $table->foreign('id_assitance')->references('assistance', 'id');
});

$db->createTable('questions', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('type')->notNull();
    $table->string('subtype');
    $table->string('description')->unique()->notNull();
    $table->primary('id');
});

$db->createTable('proffesors', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->createTable('answers', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->integer('value')->size('normal')->notNull();
    $table->integer('votes')->size('normal')->notNull();
    $table->primary('id');
    $table->integer('id_question')->size('normal');
    $table->integer('id_proffesor')->size('normal');
    $table->integer('id_students')->size('normal');
    $table->foreign('id_question')->references('questions', 'id');
    $table->foreign('id_proffesor')->references('proffesors', 'id');
    $table->foreign('id_students')->references('students', 'id');
});

$db->createTable('degrees', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->unique()->notNull();
    $table->primary('id');
});

$db->createTable('groups', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->primary('id');
});

$db->createTable('subjects', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
    $table->integer('course')->notNull();
    $table->integer('id_degree')->size('normal');
    $table->foreign('id_degree')->references('degrees', 'id');
    $table->unique(['name', 'id_degree']);
});

$db->createTable('polls', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->primary('id');
    $table->integer('id_subject')->size('normal');
    $table->integer('id_group')->size('normal');
    $table->integer('id_student')->size('normal');
    $table->foreign('id_subject')->references('subjects', 'id');
    $table->foreign('id_group')->references('groups', 'id');
    $table->foreign('id_student')->references('students', 'id');
});

$questions = [
    [
        'type' => 'PLANIFICACION DE LA ENSEÑANZA Y APRENDIZAJE',
        'subtype' => null,
        'description' => 'El/la profesor/a informa sobre los distintos aspectos de la guía docente o programa dela asignatura (objetivos, actividades, contenidos del temario, metodología, bibliografía,sistemas de evaluación,...)',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de las obligaciones docentes',
        'description' => 'Imparte las clases en el horario fijado',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de las obligaciones docentes',
        'description' => 'Asiste regularmente a clase',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de las obligaciones docentes',
        'description' => 'Cumple adecuadamente su labor de tutoría (presencial o virtual)',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de las obligaciones docentes',
        'description' => 'Se ajusta a la planificación de la asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de la Planificación',
        'description' => 'Se han coordinado las actividades teóricas y prácticas previstas',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de la Planificación',
        'description' => 'Se ajusta a los sistemas de evaluación especificados en la guía docente/programa de la asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de la Planificación',
        'description' => 'La bibliografía y otras fuentes de información recomendadas en el programa son útilespara el aprendizaje de la asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Cumplimiento de la Planificación',
        'description' => 'El/la profesor/a organiza bien las actividades que se realizan en clase',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Metodología Docente',
        'description' => 'Utiliza recursos didácticos (pizarra, transparencias, medios audiovisuales, material de apoyo en red virtual...) que facilitan el aprendizaje',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Metodología Docente',
        'description' => 'Explica con claridad y resalta los contenidos importantes',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Se interesa por el grado de comprensión de sus explicaciones',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Expone ejemplos en los que se ponen en práctica los contenidos de la asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Explica los contenidos con seguridad',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Resuelve las dudas que se le plantean',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Fomenta un clima de trabajo y participación',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Propicia una comunicación fluida y espontánea',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Motiva a los/as estudiantes para que se interesen por la asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Es respetuoso/a en el trato con los/las estudiantes',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Tengo claro lo que se me va a exigir para superar esta asignatura',
    ],
    [
        'type' => 'DESARROLLO DE LA DOCENCIA',
        'subtype' => 'Competencias docentes desarrolladas por el/la profesor/a',
        'description' => 'Los criterios y sistemas de evaluación me parecen adecuados, en el contexto de la asignatura',
    ],
    [
        'type' => 'RESULTADOS',
        'subtype' => null,
        'description' => 'Las actividades desarrolladas (teóricas, prácticas, de trabajo individual, en grupo,...)contribuyen a alcanzar los objetivos de la asignatura',
    ],
    [
        'type' => 'RESULTADOS',
        'subtype' => null,
        'description' => 'Estoy satisfecho/a con la labor docente de este/a profesor/a',
    ],
];

$subjects = [
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos Fisicos y Electronicos de la Informatica',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Estructura de Computadores',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Informatica General',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Introduccion a la Programacion',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Metodologia de la Programacion',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Algebra',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Matematica Discreta',
        'id_degree' => 1,
        'course' => 1,
    ],
    [
        'name' => 'Bases de Datos',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria del Software',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Inteligencia Artificial',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Analisis de Algoritmos y Estructura de Datos',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Diseño de Algoritmos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Estructura de Datos No Lineales',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Programacion Orientada a Objetos',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos Informaticos',
        'id_degree' => 1,
        'course' => 4,
    ],
    [
        'name' => 'Arquitectura de Computadores',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Programacion Concurrente y de Tiempo Real',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Redes de Computadores',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Sistemas Distribuidos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Sistemas Operativos',
        'id_degree' => 1,
        'course' => 2,
    ],
    [
        'name' => 'Complejidad Computacional',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Modelos de Computacion',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Procesadores de Lenguajes',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Teoria de Automatas y Lenguajes Formales',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Aprendizaje Computacional',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Percepcion',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Reconocimiento de Patrones',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Sistemas Inteligentes',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Arquitecturas de Computadores Paralelos y Distribuidos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Programacion Paralela y Distribuida',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Diseño Avanzado de Arquitectura de Computadores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Diseño Basado en Microprocesadores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Computadores Empotrados',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Tecnicas de Diseño de Computadores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Administración y Seguridad de Redes de Computadores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Redes de Computadores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Sistema Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria de Requisitos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Verificacion y Validacion del Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Calidad del Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Direccion y Gestion de Proyectos Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Metodologías y Procesos Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Evolucion del Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Implementacion e Implantacion de Sistemas Software',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Desarrollo de Sistemas Hipermedia',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Programacion en Internet',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Recuperacion de la Informacion',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria de Sistemas de Informacion',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Sistemas de Informacion en la Empresa',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Administración de Bases de Datos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Tecnologias Avanzadas de Bases de Datos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Tecnologias de Inteligencia de Negocio',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Administración de Servidores',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Interconexion de Redes',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Calidad de los Sistemas Informaticos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Seguridad en los Sistemas Informaticos',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Desarrollo de Sistemas Multimedia',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Ingeniera Web',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Internet y Negocio Electronico',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Programacion Web',
        'id_degree' => 1,
        'course' => 3,
    ],
    [
        'name' => 'Proyecto de Fin de Grado',
        'id_degree' => 1,
        'course' => 4,
    ],
    [
        'name' => 'Algebra y Geometria',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Ampliacion de Matematicas',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Fisica I',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Fisica II',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Quimica',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Informatica',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Expresion Grafica y Diseño Asistido',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Termotecnia',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Mecanica de Fluidos',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Ciencia E Ingenieria de los Materiales',
        'id_degree' => 6,
        'course' => 1,
    ],
    [
        'name' => 'Electrotecnia',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Automatica',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Teoria de Mecanismos y Maquinas',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales I',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria de Fabricacion',
        'id_degree' => 6,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos de Ingenieria',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Dibujo Industrial',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Gestion de la Produccion',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Prevencion Industrial de Riesgos',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Maquinas Electricas',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Accionamientos Electricos',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Instalaciones Electricas',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Lineas y Redes Electricas',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Sistemas Electricos de Potencia',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Centrales Electricas',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Ampliacion de Electrotecnia',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Automatizacion Industrial',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Grafica',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Calculo, Construccion y Ensayo de Maquinas',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Termica',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales II',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Calculo y Diseño de Estructuras',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Fluidomecanica',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria y Tecnología de Materiales',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Tecnologias de Fabricacion',
        'id_degree' => 6,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Subestaciones y Centros de Transformacion',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Construccion y Ensayo de Maquinas Electricas',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Generacion Distribuida de Energia Electrica',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial Electrico',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Calidad de Suministro',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Medidas Electricas Industriales',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Dispositivos Electronicos Avanzados',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Sistemas Automaticos en Edificios Inteligentes',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Tecnicas Avanzadas de Simulacion y Control de Procesos Industriales',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Aparatos de Elevacion, Transporte y Manutencion',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Mecanica de Robots',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Mecanismos y Maquinas',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Fabricacion Asistida',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Ingenieria de Procesos de Conformado con Conservacion de Materiales',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Ingeniera del Mecanizado',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Estructuras Metalicas, de Hormigon y Cimentaciones',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Mecanica Analitica',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Metodos de Analisis de Estructuras',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Aplicaciones Micro-Roboticas',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Gestion de la Calidad Industrial',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Modelos Matematicos y Estadisticos en Ingenieria',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Topografia',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Instalaciones Industriales',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Trabajo Fin de Grado',
        'id_degree' => 6,
        'course' => 4,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Fisica I',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Expresion Grafica y Diseño Asistido',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Informatica',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Algebra y Geometria',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Quimica',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Fisica II',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Teoria y Estetica del Diseño Industrial',
        'id_degree' => 2,
        'course' => 1,
    ],
    [
        'name' => 'Ampliacion de Matematicas',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria Energetica y Fluidomecanica',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Resistencia de Materiales',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Teoria de Mecanismos y Maquinas',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Electronica y Automatizacion del Producto',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Ciencia e Ingenieria de los Materiales',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Procesos Industriales',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Dibujo Tecnico del Producto',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos de Diseño',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Desarrollo Historico-Culturales del Diseño Industrial',
        'id_degree' => 2,
        'course' => 2,
    ],
    [
        'name' => 'Fundamentos del Diseño',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Comunicacion',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Metodologia del Diseño',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Diseño Ergonomico y Ecodiseño',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Envase y Embalaje',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Diseño Asistido por Ordenador',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Ingeniera Grafica del Producto',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Materiales para el Diseño',
        'id_degree' => 2,
        'course' => 3,
    ],
    [
        'name' => 'Calidad y Gestion del Diseño',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Creacion Digital',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Diseño Corporativo e Identidad Visual',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Taller de Diseño',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Fotografia y Tratamiento Digital',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Creacion de Nuevos Productos',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Desarrollo Optimo del Producto y Diseño de Experimentos',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Gestion del Ciclo de Vida del Producto',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Gestion y Evaluacion Virtual del Producto',
        'id_degree' => 2,
        'course' => 4,
    ],
    [
        'name' => 'Algebra y Geometria',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Ampliacion de Matematicas',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Fisica I',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Fisica II',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Quimica',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Informatica',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Expresion Grafica y Diseño Asistido',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Termotecnia',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Mecanica de Fluidos',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Ciencia e Ingenieria de los Materiales',
        'id_degree' => 3,
        'course' => 1,
    ],
    [
        'name' => 'Electrotecnia ',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Automatica',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales I',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria de Fabricacion',
        'id_degree' => 3,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos de Ingenieria',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Dibujo Industrial',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Gestion de la Produccion',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Prevencion Industrial de Riesgos',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Maquinas Electricas',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Accionamientos Electricos',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Instalaciones Electricas',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Lineas y Redes Electricas',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Sistemas Electricos de Potencia',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Centrales Electricas',
        'id_degree' => 3,
        'course' => 3,
    ],
    [
        'name' => 'Diseño de Subestaciones y Centros de Transformacion',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Construccion y Ensayo de Maquinas Electricas',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Generacion Distribuida de Energia Electrica',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial Electrico',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Calidad de Suministro',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Medidas Electricas Industriales',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Aplicaciones Micro-Roboticas',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Gestion de la Calidad Industrial',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Modelos Matematicos y Estadisticos en Ingenieria',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Topografia',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Instalaciones Industriales',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Oficina Tecnica, Legislación y Normalización en Ingenieria Industrial',
        'id_degree' => 3,
        'course' => 4,
    ],
    [
        'name' => 'Algebra y Geometria',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Ampliacion de Matematicas',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Fisica I',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Fisica II',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Quimica',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Informatica',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Expresion Grafica y Diseño Asistido',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Termotecnia',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Mecanica de Fluidos',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Ciencia e Ingenieria de los Materiales',
        'id_degree' => 4,
        'course' => 1,
    ],
    [
        'name' => 'Automatica',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales I',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria de Fabricacion',
        'id_degree' => 4,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos de Ingenieria',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Dibujo Industrial',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Gestion de la Produccion',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Prevencion Industrial de Riesgos',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Electronica Analogica',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Electronica Digital',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Electronica de Potencia',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Instrumentacion Electronica',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Regulacion Automatica',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Automatizacion Industrial',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Informatica Industrial',
        'id_degree' => 4,
        'course' => 3,
    ],
    [
        'name' => 'Diseño Electronico Configurable',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Diseño y Desarrollo de Prototipos Electronicos',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Dispositivos Electronicos Avanzados',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Sistemas Automaticos en Edificios Inteligentes',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Tecnicas Avanzadas de Simulacion y Control de Procesos Industriales',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Sistemas Automaticos Basados en Microcontroladores',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Aplicaciones Micro-Roboticas',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Gestion de la Calidad Industrial',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Modelos Matematicos y Estadisticos en Ingenieria Industrial',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Topografia',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Instalaciones Industriales',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',
        'id_degree' => 4,
        'course' => 4,
    ],
    [
        'name' => 'Algebra y Geometria',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Calculo',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Estadistica',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Ampliacion de Matematicas',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Fisica I',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Fisica II',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Química',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Fundamentos de Informatica',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Organizacion y Gestion de Empresas',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Expresion Grafica y Diseño Asistido',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Termotecnia',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Mecanica de Fluidos',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Ciencia e Ingenieria de los Materiales',
        'id_degree' => 5,
        'course' => 1,
    ],
    [
        'name' => 'Electrotecnia',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Automatica',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Teoria de Mecanismos y Maquinas',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales I',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Ingenieria de Fabricacion',
        'id_degree' => 5,
        'course' => 2,
    ],
    [
        'name' => 'Proyectos de Ingenieria',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Dibujo Industrial',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Gestion de la Produccion',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Prevencion Industrial de Riesgos',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Grafica',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Calculo, Construccion y Ensayo de Maquinas',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Termica',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Elasticidad y Resistencia de Materiales II',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Calculo y Diseño de Estructuras',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria Fluidomecanica',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Ingenieria y Tecnologia de Materiales',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Tecnologias de Fabricacion',
        'id_degree' => 5,
        'course' => 3,
    ],
    [
        'name' => 'Aparatos de Elevacion, Transporte y Manutencion',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Mecanica de Robots',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Mecanismos y Maquinas',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Fabricacion Asistida',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Ingenieria de Procesos de Conformado con Conservacion de Materiales',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Ingenieria del Mecanizado',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Estructuras Metalicas, de Hormigon y Cimentaciones',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Mecanica Analitica',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Metodos de Analisis de Estructuras',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Aplicaciones Micro-Roboticas',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Gestion de la Calidad Industrial',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Modelos Matematicos y Estadisticos en Ingenieria',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Topografia',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Instalaciones Industriales',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Mantenimiento Industrial',
        'id_degree' => 5,
        'course' => 4,
    ],
    [
        'name' => 'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',
        'id_degree' => 5,
        'course' => 4,
    ],
];

$proffesors = [
    'Agueda Vazquez Lopez-Escobar',
    'Agustin Consegliere Castilla',
    'Alberto Fernandez Ros',
    'Alberto Gabriel Salguero Hidalgo',
    'Alberto Sanchez Alzola',
    'Alejandro Calderon Sanchez',
    'Alejandro Perez Peña',
    'Alejandro Rincon Casado',
    'Alfonso Garcia de Prado Fontela',
    'Alvaro Gomez Parra',
    'Alvaro Ruiz Pardo',
    'Andres Pastor Fernandez',
    'Andres Yañez Escolano',
    'Angel Cervera Paz',
    'Angel Quiros Olozabal',
    'Antonia Estero Botaro',
    'Antonio Balderas Alberico',
    'Antonio Gamez Mellado',
    'Antonio J. Tomeu Hardasmal',
    'Antonio Jesus Molina Cabrera',
    'Antonio Jesus Sanchez Guirado',
    'Antonio Jose Macias Sanchez',
    'Antonio Piqueras Lerena',
    'Antonio Sala Perez',
    'Arturo Morgado Estevez',
    'Ascension Torres Martinez',
    'Bernabe Dorronsoro Diaz',
    'Carlos Corrales Alba',
    'Carlos Rioja del Rio',
    'Carlos Rodriguez Cordon',
    'Carmen Garcia Lopez',
    'Carmen Garcia Lopez',
    'Clemente Cobos Sanchez',
    'Cristina Pinedo Rivilla',
    'Daniel Molina Cabrera',
    'Daniel Moreno Nieto',
    'Daniel Sanchez Morillo',
    'Dario Miguel Ramiro Aparicio',
    'David Barbosa Rendon',
    'David Gonzalez Robledo',
    'David Repeto Garcia',
    'Domingo Javier Holgado Corrales',
    'Eduardo Alejandro Romero Bruzon',
    'Elena Orta Cuevas',
    'Elisa Guerrero Vazquez',
    'Elisa Moreno Lobaton',
    'Eloisa Ramirez Pousa',
    'Enrique Angel Rodriguez Jara',
    'Esther Lidia Silva Ramirez',
    'Eugenio Juarez Clavain',
    'Faustino Valdes Diaz',
    'Fernando Perez Peña',
    'Francisco Damian Ortega Molina',
    'Francisco Fernandez Zacarias',
    'Francisco Javier Garcia Pacheco',
    'Francisco Javier Moreno Dorado',
    'Francisco Jose Gonzalez Gutierrez',
    'Francisco Jose Lucas Fernandez',
    'Francisco Jose Pacheco Ramirez',
    'Francisco Jose Sanchez de la Flor',
    'Francisco Mesa Varela',
    'Francisco Ortus Escuder',
    'Francisco Palomo Lozano',
    'Francisco Periañez Gomez',
    'Gerardo Aburruzaga Garcia',
    'German Alvarez Tey',
    'German Jimenez Ferrer',
    'Gonzalo Ruiz Cagigas',
    'Guadalupe Ortiz Bellot',
    'Guillermo Barcena Gonzalez',
    'Higinio Sanchez Sainz',
    'Ignacio Javier Perez Galvez',
    'Inmaculada Medina Bulo',
    'Isabel Ramirez Brenes',
    'Ivan Ruiz Rube',
    'Jesus Roman Alvarez-Ossorio',
    'Joaquin Pizarro Junquera',
    'Jose Alonso de la Huerta',
    'Jose Antonio Ortega Perez',
    'Jose Antonio Ortega Perez',
    'Jose Cano Martin',
    'Jose Diaz Garcia',
    'Jose Enrique Diaz Vazquez',
    'Jose Fidel Argudo Argudo',
    'Jose Francisco Moreno Verdulla',
    'Jose Lorenzo Trujillo',
    'Jose Luis Cardenas Leal',
    'Jose Luis Gilabert Villard',
    'Jose Luis Isla Montes',
    'Jose M. Sanchez Amaya',
    'Jose Manuel Enriquez de Salamanca Garcia',
    'Jose Maria Garcia Barcena',
    'Jose Maria Guerrero Rodriguez',
    'Jose Maria Portela Nuñez',
    'Jose Maria Rodriguez Corral',
    'Jose Maria Sierra Fernandez',
    'Jose Miguel Mota Macias',
    'Jose Miguel Sanchez Sola',
    'Jose Ricardo Iglesias Quintero',
    'Jose Sanchez Ramos',
    'Juan Andres Martin Garcia',
    'Juan Antonio Landroguez Estevez',
    'Juan Antonio Molina Agea',
    'Juan Antonio Viso Perez',
    'Juan Boubeta Puig',
    'Juan Ignacio Colombo Roquette',
    'Juan Jose Dominguez Jimenez',
    'Juan Jose Monedero Rojo',
    'Juan Luis Beira Jimenez',
    'Juan Luis Peralta Saez',
    'Juan Manuel Casal Ramos',
    'Juan Manuel Dodero Beardo',
    'Juan Miguel Nuñez Orihuela',
    'Juan Ramon Astorga Ramirez',
    'Lorena Gutierrez Madroñal',
    'Lucia Rodriguez Parada',
    'Luis Garcia Barrachina',
    'Luis Lopez Molina',
    'Luis Miguel Marin Trechera',
    'Luis Rubio Peña',
    'Manuel Barrena Izquierdo',
    'Manuel Jesus Cobo Martin',
    'Manuel Jesus Garquez Gonzalez',
    'Manuel Jesus Lopez Sanchez',
    'Manuel Lopez Coello',
    'Manuel Matias Casado',
    'Manuel Otero Mateo',
    'Manuel Palomo Duarte',
    'Manuel Piñero de los Rios',
    'Manuel Prian Rodriguez',
    'Manuel Tornell Barbosa',
    'Manuel Viseras Pico',
    'Maria Alicia Cornejo Barrios',
    'Maria Alonso Garcia',
    'Maria Angeles Cifredo Chacon',
    'Maria Araceli Garcia Yeguas',
    'Maria Carmen Castro Cabrera',
    'Maria de la Paz Guerrero Lebrero',
    'Maria del Pilar Villar Castro',
    'Maria Dolores Ruiz Jimenez',
    'Maria Eloisa Yrayzoz Diaz de Liaño',
    'Maria Jose Burgos Navarro',
    'Maria Luisa de la Rosa Portillo',
    'Maria Luisa Sunico Riaño',
    'Maria Teresa Garcia Horcajadas',
    'Mariano Marcos Barcena',
    'Marina Nicasio Llach',
    'Maximo Perez Braza',
    'Mercedes Rodriguez Garcia',
    'Mercedes Ruiz Carreira',
    'Miguel Alvarez Alcon',
    'Miguel Angel Bolivar Perez',
    'Miguel Angel Fernandez Granero',
    'Miguel Suffo Pino',
    'Milagros Huerta Gomez de Merodio',
    'Miriam Herrera Collado',
    'Moises Batista Ponce',
    'Nestor Mora Nuñez',
    'Nuria Chinchilla Salcedo',
    'Nuria Hurtado Rodriguez',
    'Pablo de la Torre Moreno',
    'Pablo Garcia Sanchez',
    'Pablo Garcia Sanchez',
    'Pablo Pavon Dominguez',
    'Patricia Ruiz Villalobos',
    'Pedro Delgado Perez',
    'Pedro Fernandez Fernandez',
    'Pedro Francisco Mayuet Ares',
    'Pedro Jose Nadal de Mora',
    'Pedro Luis Galindo Riaño',
    'Pedro Merino Alcon',
    'Perpetua Gonzalez Garcia',
    'Rafael Bienvenido Barcena',
    'Rafael Gomez Sanchez',
    'Rafael Jimenez Castañeda',
    'Rafael Ravina Ripoll',
    'Raquel Ureña Perez',
    'Rosario Garcia Garcia',
    'Santiago Fandiño Patiño',
    'Sergio Ignacio Molina Rubio',
    'Severo Raul Fernandez Vidal',
    'Sol Saez Martinez',
    'Soledad Moreno Pulido',
    'Sonia Velazquez Leris',
    'Tomas Acedo Alberto',
    'Ursula Torres Parejo',
    'Vicente Lopez Pena',
    'Victor Manuel Sanchez Corbacho',
    'Victor Perez Fernandez',
];

$db->insertMany($questions, 'questions');

$db->insertMany(['GII', 'GIDIDP', 'GIE', 'GIEI', 'GIM', 'GITI'], 'degrees', 'name');

$db->insertMany([1, 2, 3], 'groups', 'id');

$db->insertMany($subjects, 'subjects');

$db->insertMany($proffesors, 'proffesors', 'name');

$db->insertMany(['Femenino', 'Masculino', 'Otro'], 'gender', 'name');

$db->insertMany(['Nada', 'Algo', 'Bastante', 'Mucho'], 'mentoring', 'name');

$db->insertMany(['Nada', 'Algo', 'Bastante', 'Mucho'], 'interest', 'name');

$db->insertMany(['Baja', 'Media', 'Alta', 'Muy Alta'], 'dificulty', 'name');

$db->insertMany(['Menos del 50%', 'Entre 50% y 80%', 'Más de 80%'], 'assistance', 'name');

$db->insertMany(['No Presentado', 'Suspenso', 'Aprobado', 'Notable', 'Sobresaliente', 'Matriculo de Honor'], 'expected_grade', 'name');
