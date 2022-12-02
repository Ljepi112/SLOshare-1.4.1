@extends('errors.layout')

@section('title', 'NAPAKA 400: Slaba prošnja!)

@section('description', $exception->getMessage() ?: 'Strežnik ni mogel razumeti zahteve zaradi napačno oblikovane sintakse. Stranka NE SME ponoviti zahteve brez sprememb.')
