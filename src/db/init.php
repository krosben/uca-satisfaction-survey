<?php

require_once __DIR__.'/../../vendor/autoload.php';

use Opis\Database\Connection;
use Opis\Database\Database;
use Opis\Database\Schema\CreateTable;

$connection = new Connection(
    getenv('DB_DSN'),
    getenv('DB_USER'),
    getenv('DB_PASS')
);

$db = new Database($connection);

$db->schema()->create('gender', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('mentoring', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('interest', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('dificulty', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('expected_grade', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('assistance', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('students', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->integer('age')->size('normal')->notNull();
    $table->string('age')->notNull();
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

$db->schema()->create('questions', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('type')->notNull();
    $table->string('subtype');
    $table->string('description')->unique()->notNull();
    $table->primary('id');
});

$db->schema()->create('proffesors', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('answers', function (CreateTable $table) {
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

$db->schema()->create('degrees', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->unique()->notNull();
    $table->primary('id');
});

$db->schema()->create('groups', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->primary('id');
});

$db->schema()->create('subjects', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
    $table->integer('course')->notNull();
    $table->integer('id_degree')->size('normal');
    $table->foreign('id_degree')->references('degrees', 'id');
    $table->unique(['name', 'id_degree']);
});

$db->schema()->create('polls', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('normal')->notNull();
    $table->primary('id');
    $table->integer('id_subject')->size('normal');
    $table->integer('id_group')->size('normal');
    $table->integer('id_student')->size('normal');
    $table->foreign('id_subject')->references('subjects', 'id');
    $table->foreign('id_group')->references('groups', 'id');
    $table->foreign('id_student')->references('students', 'id');
});
