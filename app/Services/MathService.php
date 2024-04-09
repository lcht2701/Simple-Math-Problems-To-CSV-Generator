<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class MathService
{
    public function exportToCsv($columnAdd, $columnSub, $row)
    {
        $data1 = $this->generateAddition($columnAdd, $row);
        $data2 = $this->generateSubtraction($columnSub, $row);
        $result = array_merge($data1, $data2);
        shuffle($result);
        $fileName = 'math_generation.csv';
        $path = Storage::path($fileName);
        $handle = fopen($path, 'w');

        foreach ($result as $column) {
            fputcsv($handle, $column);
        }
        fclose($handle);
        return $path;
    }

    public function generateAddition($column, $row)
    {
        $result = [];
        for ($i = 0; $i < $column; $i++) {
            $resultRow = [];
            for ($j = 0; $j < $row; $j++) {
                do {
                    $num1 = rand(10, 90);
                    $num2 = rand(10, 90);
                } while ($num1 + $num2 > 100 || $this->hasCarry($num1, $num2, 'add'));
                $resultRow[] = "$num1 + $num2 = ...";
            }
            $result[] = $resultRow;
        }
        return $result;
    }

    public function generateSubtraction($column, $row)
    {
        $result = [];
        for ($i = 0; $i < $column; $i++) {
            $resultRow = [];
            for ($j = 0; $j < $row; $j++) {
                do {
                    $num1 = rand(10, 90);
                    $num2 = rand(10, 90);
                } while ($num1 - $num2 < 0 || $this->hasCarry($num1, $num2, 'sub'));
                $resultRow[] = "$num1 - $num2 = ...";
            }
            $result[] = $resultRow;
        }
        return $result;
    }

    private function hasCarry($num1, $num2, $method)
    {
        while ($num1 > 0 && $num2 > 0) {
            switch ($method) {
                case 'add':
                    if (($num1 % 10) + ($num2 % 10) >= 10) {
                        return true;
                    }
                    break;
                case 'sub':
                    if (($num1 % 10) - ($num2 % 10) < 0) {
                        return true;
                    }
                    break;
                default:
                    break;
            }
            $num1 = intval($num1 / 10);
            $num2 = intval($num2 / 10);
        }
        return false;
    }
}
