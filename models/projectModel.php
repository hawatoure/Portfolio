<?php

    class ProjectModel{

        public int $id_project;
        public  string $name;
        public  string $description;
        public  string $date_start;
        public  ?string $date_end;
        public  ?string $link_site;
        public  ?string $link_git;
        public string $cover;
        public array $pictures;


        public function displayDateStart(){
            $dateTime = DateTime::createFromFormat("Y-m-d", $date_start);
            $this->date_start;
            return $dateTime->format("d-m-y");
        }
        public function displayDateEnd(){
            $dateTime = DateTime::createFromFormat("Y-m-d", $date_end);
            $this->date_end;
            return $dateTime->format("d-m-y");
        }

        




    }

?>
