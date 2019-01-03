<?php

    class Controller {
        private $model;

        public function __construct(Model $model) {
            $this->model = $model;
        }

        /**
         * Handle the click event in the VIEW
         * then change data in the MODEL
         */
        public function click() {
            $this->model->text = 'Hello World!';
        }
    }