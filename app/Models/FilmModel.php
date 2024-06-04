<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class FilmModel extends Model
{
    protected $table = 'films';
    protected $primaryKey = 'id';
    protected $allowedFields = ['genre', 'title', 'rilis', 'synopsis', 'image', 'rating', 'like', 'dislike','trailer'];

    public function calculateAverageRating($film_id)
    {
        $totalRating = $this->db->table('films')
                                ->select('AVG(rating) as average_rating')
                                ->where('film_id', $film_id)
                                ->get()
                                ->getRowArray();

        return $totalRating['average_rating']; 
    }

    public function calculateTotalLikeDislike($film_id)
    {
        $totalLikesDislikes = $this->db->table('films')
                                       ->selectSum('like', 'total_like')
                                       ->selectSum('dislike', 'total_dislike')
                                       ->where('film_id', $film_id)
                                       ->get()
                                       ->getRowArray();
        return $totalLikesDislikes;
    }
     
    public function getFilm($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }

    public function saveFilm($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editFilm($data,$id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }


    public function hapusFilm($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id' => $id]);
    }
 
}
