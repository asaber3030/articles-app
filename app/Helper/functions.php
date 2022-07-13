<?php

use App\Models\FavSteps;
use App\Models\FavArticles;
use App\Models\FavCourses;

const APP_NAME = 'keepLearning()';

function time_formatter($time, $format = 'd/m/Y - h:i A') {
  return date($format, strtotime($time));
}

function username() {
  return auth()->user()->username;
}
function skills() {
  return auth()->user()->skills;
}

function id() {
  return auth()->id();
}

function firstname() {
  return auth()->user()->firstname;
}

function lastname() {
  return auth()->user()->lastname;
}

function fullname() {
  return auth()->user()->firstname . ' ' . auth()->user()->lastname;
}

function email() {
  return auth()->user()->email;
}

function picture() {
  return auth()->user()->picture;
}

function job_title() {
  return auth()->user()->job_title;
}

function bio() {
  return auth()->user()->bio;
}

function phone() {
  return auth()->user()->phone;
}

function website() {
  return auth()->user()->website;
}

function count_my_bookmarks() {
  $favs_s = FavSteps::where('fs_user', id())->get();
  $favs_c = FavCourses::where('fc_user', id())->get();
  $favs_a = FavArticles::where('fa_user', id())->get();
  return  count($favs_c) + count($favs_a) + count($favs_s);
}
function count_courses_bookmarks() {
  return FavCourses::where('fc_user')->get()->count();
}
function count_articles_bookmarks() {
  return FavArticles::where('fa_user')->get()->count();
}
function count_steps_bookmarks() {
  return FavSteps::where('fs_user')->get()->count();
}

