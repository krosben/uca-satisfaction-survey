<?php

echo __DIR__.'/../../vendor/autoload.php';
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

$db->schema()->create('students', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->integer('age')->size('tiny')->notNull();
    $table->string('age')->notNull();
    $table->integer('highest_course')->size('tiny')->notNull();
    $table->integer('lowest_course')->size('tiny')->notNull();
    $table->integer('enrollment')->size('tiny')->notNull();
    $table->integer('exam')->size('tiny')->notNull();
    $table->string('interest')->notNull();
    $table->string('mentoring')->notNull();
    $table->string('dificulty')->notNull();
    $table->string('expected_grade')->notNull();
    $table->float('assistance')->notNull();
    $table->primary('id');
});

$db->schema()->create('questions', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->string('type')->unique()->notNull();
    $table->string('subtype');
    $table->string('description')->unique()->notNull();
    $table->primary('id');
});

$db->schema()->create('proffesors', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->string('name')->notNull();
    $table->primary('id');
});

$db->schema()->create('answers', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->integer('value')->size('tiny')->notNull();
    $table->integer('votes')->size('tiny')->notNull();
    $table->primary('id');
    $table->integer('id_question')->size('tiny');
    $table->integer('id_proffesor')->size('tiny');
    $table->integer('id_students')->size('tiny');
    $table->foreign('id_question')->references('questions', 'id');
    $table->foreign('id_proffesor')->references('proffesors', 'id');
    $table->foreign('id_students')->references('students', 'id');
});

$db->schema()->create('degrees', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->string('name')->unique()->notNull();
    $table->primary('id');
});

$db->schema()->create('groups', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->primary('id');
});

$db->schema()->create('subjects', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->string('name')->unique()->notNull();
    $table->primary('id');
    $table->integer('id_degree')->size('tiny');
    $table->foreign('id_degree')->references('degrees', 'id');
});

$db->schema()->create('polls', function (CreateTable $table) {
    $table->integer('id')->autoincrement()->size('tiny')->notNull();
    $table->primary('id');
    $table->integer('id_subject')->size('tiny');
    $table->integer('id_group')->size('tiny');
    $table->integer('id_student')->size('tiny');
    $table->foreign('id_subject')->references('subjects', 'id');
    $table->foreign('id_group')->references('groups', 'id');
    $table->foreign('id_student')->references('students', 'id');
});
