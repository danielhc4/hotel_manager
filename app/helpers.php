<?php

	function dateSpanish() {
		$weekday = weekdaySpanish(date('l'));
		$month = monthSpanish(date('F'));
		$day = date('j');
		return $weekday . ', ' . $month . ' ' . $day;
	}

	function weekdaySpanish(string $weekday) : string {
		$spanishWeekday = $weekday;
		switch(strtolower($weekday)) {
			case 'monday':
				$spanishWeekday = 'Lunes';
			break;
			case 'tuesday':
				$spanishWeekday = 'Martes';
			break;
			case 'wednesday':
				$spanishWeekday = 'Miércoles';
			break;
			case 'thursday':
				$spanishWeekday = 'Jueves';
			break;
			case 'friday':
				$spanishWeekday = 'Viernes';
			break;
			case 'saturday':
				$spanishWeekday = 'Sábado';
			break;
			case 'sunday':
				$spanishWeekday = 'Domingo';
			break;
		}
		return $spanishWeekday;
	}

	function monthSpanish(string $month) : string {
		$spanishMonth = $month;
		switch(strtolower($month)) {
			case 'january':
				$spanishMonth = 'Enero';
			break;
			case 'february':
				$spanishMonth = 'Febrero';
			break;
			case 'march':
				$spanishMonth = 'Marzo';
			break;
			case 'april':
				$spanishMonth = 'Abril';
			break;
			case 'may':
				$spanishMonth = 'Mayo';
			break;
			case 'june':
				$spanishMonth = 'Junio';
			break;
			case 'july':
				$spanishMonth = 'Julio';
			break;
			case 'august':
				$spanishMonth = 'Agosto';
			break;
			case 'september':
				$spanishMonth = 'Septiembre';
			break;
			case 'october':
				$spanishMonth = 'Octubre';
			break;
			case 'november':
				$spanishMonth = 'Noviembre';
			break;
			case 'december':
				$spanishMonth = 'Diciembre';
			break;
		}
		return $spanishMonth;
	}