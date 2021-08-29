<?php


namespace App;


trait Searchable
{



        public static function search($array){
            $result = new static();
            $i = 0;
            foreach ($array as $item){
                if(isset($item[2])){
                    if(!is_null($item[2])){
                        if($item[1] == "like"){
                            if($i == 0){
                                $result = $result::where($item[0],"like","%". $item[2] . "%");
                            }
                            else{
                                $result = $result->where($item[0],"like","%". $item[2] . "%");
                            }
                        }
                        elseif ($item[1] == "in"){
                            if($i == 0){
                                $result = $result::whereIn($item[0],[(int)$item[2]]);
                            }
                            else{
                                $result = $result->whereIn($item[0],[(int)$item[2]]);
                            }
                        }
                        elseif ($item[1] == "exact"){
                            if($i == 0){
                                $result = $result::where($item[0],$item[2]);
                            }
                            else{
                                $result = $result->where($item[0],$item[2]);
                            }
                        }
                        elseif ($item[1] == "exact"){
                            if($i == 0){
                                $result = $result::where($item[0],$item[2]);
                            }
                            else{
                                $result = $result->where($item[0],$item[2]);
                            }
                        }
                        elseif ($item[1] == "not"){
                            if($i == 0){
                                $result = $result::where($item[0],"!=",$item[2]);
                            }
                            else{
                                $result = $result->where($item[0],"!=",$item[2]);
                            }
                        }
                        elseif ($item[1] == "inArray"){
                            if (count($item[2])> 0){
                                if($i == 0){
                                    $result = $result::whereIn($item[0],$item[2]);
                                }
                                else{
                                    $result = $result->whereIn($item[0],$item[2]);
                                }
                            }
                        }
                        elseif ($item[1] == "beetween"){
                            if (count($item[2]) == 2){
                                if($i == 0){
                                    $result = $result::whereBetween($item[0],$item[2]);
                                }
                                else{
                                    $result = $result->whereBetween($item[0],$item[2]);
                                }
                            }
                        }
                    }

                }
                $i++;
            }

            return $result;




        }









}
