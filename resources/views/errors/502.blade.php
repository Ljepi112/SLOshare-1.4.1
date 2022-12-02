@extends('errors.layout')

@section('title', 'NAPAKA 502: Slab prehod!')

@section('description', $exception->getMessage() ?: 'Strežnik je, medtem ko je deloval kot prehod ali proxy, prejel neveljaven odgovor od navzgornji strežnik, do katerega je dostopal pri poskusu izpolnitve zahteve.')
