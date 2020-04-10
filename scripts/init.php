<?php

require_once __DIR__.'/../vendor/autoload.php';

use Opis\Database\Schema\CreateTable;
use Scripts\DB;

$app = new \App\Application();

$db = new DB($app->db);

// DATABASE SCHEMA
$db->createTable('users', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('email')->notNull()->unique();
    $table->string('password')->notNull();
    $table->primary('id');
});

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
    $table->integer('id_subject')->size('normal')->notNull();
    $table->integer('id_group')->size('normal')->notNull();
    $table->integer('id_proffesor')->size('normal')->notNull();
    $table->integer('id_question')->size('normal')->notNull();
    $table->integer('id_student')->size('normal')->notNull();
    $table->integer('option')->size('normal')->notNull();
    $table->foreign('id_subject')->references('subjects', 'id');
    $table->foreign('id_group')->references('groups', 'id');
    $table->foreign('id_proffesor')->references('proffesors', 'id');
    $table->foreign('id_question')->references('questions', 'id');
    $table->foreign('id_student')->references('students', 'id');
});

$db->createTable('prof_subject', function (CreateTable $table) {
    $table->integer('id_subject')->size('normal');
    $table->integer('id_proffesor')->size('normal');
    $table->foreign('id_proffesor')->references('proffesors', 'id');
    $table->foreign('id_subject')->references('subjects', 'id');
});

// POPULATE DATABASE:
include_once __DIR__.'/data.php';

$db->insertMany([[
    'email' => 'admin@admin.com',
    'password' => password_hash('admin#77', PASSWORD_BCRYPT, ['cost' => 11]),
]], 'users');

$db->insertMany($questions, 'questions');

$db->insertMany($degrees, 'degrees');

$db->insertMany($subjects, 'subjects');

$db->insertMany($proffesors, 'proffesors');

$db->insertMany($subject_proffesor, 'prof_subject');

$db->insertMany(['Femenino', 'Masculino', 'Otro'], 'gender', 'name');

$db->insertMany(['Nada', 'Algo', 'Bastante', 'Mucho'], 'mentoring', 'name');

$db->insertMany(['Nada', 'Algo', 'Bastante', 'Mucho'], 'interest', 'name');

$db->insertMany(['Baja', 'Media', 'Alta', 'Muy Alta'], 'dificulty', 'name');

$db->insertMany(['Menos del 50%', 'Entre 50% y 80%', 'Más de 80%'], 'assistance', 'name');

$db->insertMany(['No Presentado', 'Suspenso', 'Aprobado', 'Notable', 'Sobresaliente', 'Matriculo de Honor'], 'expected_grade', 'name');

$db->insertMany([1, 2, 3], 'groups', 'id');

$app->savePoll($answers);
