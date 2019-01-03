<?php

    class View {
        private $model;

        public function __construct(Model $model) {
            $this->model = $model;
        }

        /**
         * Render the view grabbing data from the MODEL
         */
        public function render() {
            echo '<a href="index.php?lang=de&id=9&action=click">' . $this->model->text . '</a>';
        }
    }