@extends('errors.layout')

@section('title', 'NAPAKA 404: Stran ni najdena')

@section('description', $exception->getMessage() ?: 'Zahtevane strani ni mogoče najti! Niste prepričani, kaj iščete, vendar preverite naslov in poskusite znova!')
