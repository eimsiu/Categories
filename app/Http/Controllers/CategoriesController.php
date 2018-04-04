<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoriesController extends Controller
{
    public function submit(Request $request){
       $this->validate($request, [
           'name' => 'required'     //make sure the field is not empty
       ]);

       $categ = new Category;
       $categ->category = $request->input('name');
       $categ->parent = $request->input('parent');

       $categ->save();

       return redirect('./')->with('success', 'Category Added');
    }



    public function getCategoriesSelect(){
        $categ = $this->fetchCategoryTree();
        return view('addCategory')->with('categ', $categ);
    }

    public function getCategoriesTreeList(){
        $categ = $this->fetchCategoryTreeList();
        $categ2 = $this->fetchCategoryTreeIterative();

        return view('viewCategories')->with('categ', $categ)->with('categ2', $categ2);
    }

    /*
     * Recursive method for filling dropdown box
     * @parent - current node
     * @spacing - spacing to imitate tree appearance in the dropdown box
     * @user_tree_array - tree array
     * */
    private function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {

        if (!is_array($user_tree_array))
            $user_tree_array = array();

        $query = DB::table('categories')->where('parent',$parent)->orderby('id','asc')->get();
        if(count($query) > 0) {
            foreach($query as $row){
                $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->category);
                $user_tree_array = $this->fetchCategoryTree($row->id, $spacing . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $user_tree_array);
            }
        }
        return $user_tree_array;
    }

    /*
     * Iterative method for Pre-order tree traversal
     * @root - starting node
     * */
    private function fetchCategoryTreeIterative($root = 0){
        $ans = array("<ul>");   //return array
        $counter = array();     //array for how many nodes need to be passed before we put an /ul
        $test = false;          //fail check: after putting /ul, check if previous one needs to be ended
        $query = DB::table('categories')->where('parent',$root)->orderby('id','asc')->get();
        if(count($query)===0)
            return;
        $s =array(array("id" => 0, "name"=>"root"));    //array used as a stack
        while(!empty($s)){
            //do fail check
            if ($test){
                $helper = array_pop($counter);
                if ( $helper === 0) {
                    array_push($ans, "</ul>");
                }
                else {
                    array_push($counter,$helper);
                }
                $test = false;
            }

            $current = array_pop($s);
            array_push($ans,"<li>".$current["name"]."</li>");  //print node (add to answer array)

            $query = DB::table('categories')->where('parent',$current["id"])->orderby('id','desc')->get();  //check if parent node has children
            if(count($query) > 0) {     //if yes add to stack
                $helper = array_pop($counter);
                array_push($counter,--$helper);

                array_push($ans,"<ul>");
                array_push($counter, count($query));

                foreach ($query as $row) {
                    array_push($s,array("id" => $row->id, "name" => $row->category));
                }
            }
            else {  //if not check if ul needs to be ended
                $helper = array_pop($counter);
                if ( --$helper === 0){
                    array_push($ans,"</ul>");
                    $test = true;
                }
                else {
                    array_push($counter,$helper);
                }
            }
        }
        $ans[] = "</ul>";
        array_shift($ans);  //remove root info
        array_shift($ans);
        return $ans;
    }

    /*
     * Recursive method for Pre-order tree traversal
     * @parent - current node
     * @user_tree_array - tree array
     * */
    private function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {

        if (!is_array($user_tree_array))
            $user_tree_array = array();

        $query = DB::table('categories')->where('parent',$parent)->orderby('id','asc')->get();
        if (count($query) > 0) {
            $user_tree_array[] = "<ul>";
            foreach($query as $row) {
                $user_tree_array[] = "<li>". $row->category."</li>";
                $user_tree_array = $this->fetchCategoryTreeList($row->id, $user_tree_array);
            }
            $user_tree_array[] = "</ul>";
        }
        return $user_tree_array;
    }

}
