@extends('errors.layout')

@section('title', 'NAPAKA 444')

@section('description', $exception->getMessage() ?: 'POVEZAVA ZAPRTA IN JE BREZ ODGOVORA.')
