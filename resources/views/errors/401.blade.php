@extends('errors.layout')

@section('title', 'NAPAKA 401: Nepooblaščeno!')

@section('description', $exception->getMessage() ?: 'Odziv kode napake za manjkajoč ali neveljaven žeton za preverjanje pristnosti.')
