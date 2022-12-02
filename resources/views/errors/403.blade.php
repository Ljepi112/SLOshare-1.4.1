@extends('errors.layout')

@section('title', 'NAPAKA 403: Prepovedano!')

@section('description', $exception->getMessage() ?: 'Nimate dovoljenja za izvedbo tega dejanja!')
