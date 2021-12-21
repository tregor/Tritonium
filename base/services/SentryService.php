<?php

namespace Tritonium\Base\Services;

class SentryService
{
	private $dsn;
	private $level = E_ALL;
	private $defaults = TRUE;

	public function __construct($data = NULL)
	{
		$this->dsn = $data['dsn'];
		$this->level = $data['level'];	
		$this->defaults = $data['defaults'];

		\Sentry\init([
			'dsn' => $this->dsn,
			'error_types' => $this->level,
			'default_integrations' => $this->defaults
		]);
	}

	public function log($message, $data = NULL)
	{
		\Sentry\withScope(function (\Sentry\State\Scope $scope) use ($message, $data): void {
			$scope->setLevel(\Sentry\Severity::info());
			if (!empty($data)) {
				$scope->setContext('data', $data);
			}

			\Sentry\captureMessage($message);
		});
	}

	public function debug($data)
	{
		\Sentry\withScope(function (\Sentry\State\Scope $scope) use ($data): void {
			$scope->setLevel(\Sentry\Severity::debug());
			if (!empty($data)) {
				if (is_object($data)) {
					$data = $data->toArray();
				}
				if (!is_array($data)) {
					$data = ['data' => $data];
				}
				$scope->setContext('data', $data);
			}

			\Sentry\captureMessage('Debug data');
		});
	}
}