@extends('errors.layout')

@section('title', 'NAPAKA 503: Storitev ni na voljo!')

@section('description', $exception->getMessage() ?: 'Oprostite, izvajamo vzdrževalna dela. Kmalu bomo nazaj.')
