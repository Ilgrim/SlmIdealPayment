<?php
/**
 * Copyright (c) 2012 Jurian Sluiman.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of the
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package     SlmIDealPayment
 * @author      Jurian Sluiman <jurian@juriansluiman.nl>
 * @copyright   2012 Jurian Sluiman.
 * @license     http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link        http://juriansluiman.nl
 */

use SlmIdealPayment\Client\StandardClient;

return array(
	'ideal' => array(
		'production'   => true,
		'merchant_id'  => '',
		'sub_id'       => '',

		'certificate'  => '',
		'key_file'     => '',
		'key_password' => '',

		'abn' => array(
			'test' => '',
			'live' => '',
			'certificate' => __DIR__ '/../data/abn.cer',
		),
		'ing' => array(
			'test' => 'https://idealtest.secure-ing.com/ideal/iDeal',
			'live' => 'https://ideal.secure-ing.com/ideal/iDeal',
			'certificate' => __DIR__ '/../data/ing.cer',
		),
		'rabo' => array(
			'test' => 'https://ideal.rabobank.nl/ideal/iDeal',
			'live' => 'https://idealtest.rabobank.nl/ideal/iDeal',
			'certificate' => __DIR__ '/../data/rabo.cer',
		),
	),

	'service_manager' => array(
		'factories' => array(
			'ideal-abn' => function($sm) {
				$config = $sm->get('config')->ideal;

				$url  = ($config->production) ? $config->abn->live ; $config->abn->test;
				$cert = $config->abn->certificate;

				$client = new StandardClient;
				$client->setRequestUrl($url);
				$client->setPublicCertificate($cert);

				return $client;
			},
			'ideal-ing' => function($sm) {
				$config = $sm->get('config')->ideal;

				$url  = ($config->production) ? $config->ing->live ; $config->ing->test;
				$cert = $config->ing->certificate;

				$client = new StandardClient;
				$client->setRequestUrl($url);
				$client->setPublicCertificate($cert);

				return $client;
			},
			'ideal-rabo' => function($sm) {
				$config = $sm->get('config')->ideal;

				$url  = ($config->production) ? $config->rabo->live ; $config->rabo->test;
				$cert = $config->rabo->certificate;

				$client = new StandardClient;
				$client->setRequestUrl($url);
				$client->setPublicCertificate($cert);

				return $client;
			},
		),
	),
);