<?php
    // 1st class
    class Car
    {
        public $brand;
        public $model;
        public $year;
        public $horsepower;

        public function __construct($brand, $model, $year, $horsepower)
        {
            $this->brand = $brand;
            $this->model = $model;
            $this->year = $year;
            $this->horsepower = $horsepower;
        }

        public function getDescription()
        {
            echo 'Auto '.$this->brand.' '.$this->model.' '.$this->year.' year of release and has '.$this->horsepower.' horsepowers<br>';
        }
        public function getAge()
        {
            $age = date('Y') - $this->year;
            return $age;
        }
    }
    $vwPolo = new Car('Volkswagen', 'Polo', 2016, 110);
    $yaguarSType = new Car('Jaguar', 'S-Type', 2006, 238);
    echo $vwPolo->getDescription();
    echo $yaguarSType->getAge();

    // 2nd class
    class TVset
    {
        public $brand;
        public $type;
        public $diagonal;

        public function __construct($brand, $type, $diagonal)
        {
            $this->brand = $brand;
            $this->type = $type;
            $this->diagonal = $diagonal;
        }

        public function getDiagonalMetric()
        {
            $diagonalM = $this->diagonal * 2.54;
            return $diagonalM;
        }
    }
    $zaryaTV = new TVset('Zarya', 'ELT', 20);
    $samsungTV = new TVset('Samsung', 'PDP', 43);

    // 3rd class
    class Duck
    {
        public $color;
        public $sex;
        public $wingsLength;

        public function __construct($color, $sex, $wingsLength)
        {
            $this->color = $color;
            $this->sex = $sex;
            $this->wingsLength = $wingsLength;
        }

        public function getSize()
        {
            if($this->wingsLength > 37)
            {
                return 'Big';
            } elseif($this->wingsLength <=37 && $this->wingsLength > 30) {
                return 'Medium';
            } else return 'Small';
        }
    }
    $frank = new Duck('grey', 'male', 40);
    $bella = new Duck('white', 'female', 35);

    // 4th class
    class Product
    {
        public $name;
        public $type;
        public $price;
        public $color;

        public function __construct($name, $type, $price)
        {
            $this->name = $name;
            $this->type = $type;
            $this->price = $price;
        }

        public function changeColor($color)
        {
            if($color)
            {
                $this->color = $color;
            }
        }
    }
    $teddyBear = new Product('Teddy Bear', 'toy', 250);
    $moleskin = new Product('Moleskin', 'dayplanner', 1500);
    $moleskin->changeColor('purple');

    // 5th class
    class BallPen
    {
        public $brand;
        public $color;
        public $ballThickness;

        public function __construct($brand, $color)
        {
            $this->brand = $brand;
            $this->color = $color;
        }

        public function setThickness($thickness)
        {
            if($thickness)
            {
                $this->ballThickness = $thickness;
            }
        }
    }
    $stabilo = new BallPen('Stabilo', 'black');
    $pilot = new BallPen('Pilot', 'blue');
    $pilot->setThickness(0.5);
