<?
require __DIR__ . '/../repositories/artistRepository.php';

class ArtistService
{
    private $artistRepository;

    function __construct()
    {
        $this->artistRepository = new ArtistRepository();
    }

    public function getAllArtists()
    {
        return $this->artistRepository->getAllArtists();
    }

    public function getArtistById($id)
    {
        return $this->artistRepository->getArtistById($id);
    }

    public function addArtist($artist)
    {
        return $this->artistRepository->addArtist($artist);
    }

    public function updateArtist($artist)
    {
        return $this->artistRepository->updateArtist($artist);
    }

    public function deleteArtist($id)
    {
        return $this->artistRepository->deleteArtist($id);
    }

    public function getArtistInfo($id)
    {
        return $this->artistRepository->getArtistInfo($id);
    }

    
    function getArtistDanceAppearances($id)
    {
        return  $this->artistRepository->getArtistDanceAppearances($id);
        
    }
}