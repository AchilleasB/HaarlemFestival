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

}