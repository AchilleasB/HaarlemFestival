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

    public function getSingleArtistInfo($id)
    {
        return $this->artistRepository->getSingleArtistInfo($id);
    }

    public function getAllArtistsInfo()
    {
        return  $this->artistRepository->getAllArtistsInfo();
        
    }

    function getArtistDanceAppearances($id)
    {
        return  $this->artistRepository->getArtistDanceAppearances($id);
        
    }

    public function createArtistPage($artistInfo)
    {
        return $this->artistRepository->createArtistPage($artistInfo);
    }

    public function updateArtistPageContent($artistInfo)
    {
        return $this->artistRepository->updateArtistPage($artistInfo);
    }

    public function deleteArtistPage($id)
    {
        return $this->artistRepository->deleteArtistPage($id);
    }

    public function artistPageExists($id)
    {
        return $this->artistRepository->artistPageExists($id);
    }

}