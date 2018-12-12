<?php

    class Controller {
        private $model;

        public function __construct(Model $model) {
            $this->model = $model;
        }

        public function click() {
            $this->model->text = 'Hello World!';
        }
    }