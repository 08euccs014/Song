<?php

abstract class gateway
{
	public function request()
	{
		return true;
	}

	public function response()
	{
		return false;
	}
}