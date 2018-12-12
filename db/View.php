<?php

    class View {
        private $model;

        public function __construct(Model $model) {
            $this->model = $model;
        }

        public function render() {
            echo '<a href="index.php?lang=de&id=10&action=click">' . $this->model->text . '</a>';
        }
    }