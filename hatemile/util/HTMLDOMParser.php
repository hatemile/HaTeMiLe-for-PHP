<?php
/*
Copyright 2014 Carlson Santana Cruz

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 */

namespace hatemile\util;

interface HTMLDOMParser {
	public function find($selector);
	public function findChildren($selector);
	public function findDescendants($selector);
	public function findAncestors($selector);
	public function firstResult();
	public function lastResult();
	public function listResults();
	public function createElement($tag);
	public function getHTML();
	public function clearParser();
}