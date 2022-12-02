@extends('errors.layout')

@section('title', 'NAPAKA 405: Metoda ni dovoljena!')

@section('description', $exception->getMessage() ?: 'Metoda, ki jo poskušate, je uporaba, ta strežnik ne dovoljuje.')
