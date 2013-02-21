<?php
/**
 * @author Leonardo Allegrini
 * @copyright 2013 Leonardo Allegrini
 */
class Action {
/* Functions */
public static function postLyrics($apikey,$url) {
  $idTrack = self::getTrackId($url,$apikey);
  $lyrics = self::getTrackLyrics($url,$idTrack,$apikey);
  return $lyrics;
}
private static function getTrackId($url,$apikey) {
    $artist = str_replace(' ','%20',$_POST['artist']);
    $song = str_replace(' ','%20',$_POST['song']);
    /*Start URL creation*/
    $urlTrackId = $url.'track.search?';
    $urlTrackId .= 'q_track='.$song;
    $urlTrackId .= '&q_artist='.$artist;
    $urlTrackId .= '&f_has_lyrics=1';
    $urlTrackId .= '&apikey='.$apikey;
    $urlTrackId .= '&format=xml';
    $urlTrackId .= '&page_size=1';
    /*End URL creation*/
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlTrackId);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $xml = simplexml_load_string($response);
    return $xml->body->track_list->track->track_id; 
}
private static function getTrackLyrics($url,$idTrack,$apikey) {
        /*Start URL creation*/
        $urlTrackLyrics = $url.'track.lyrics.get?';
        $urlTrackLyrics .= 'track_id='.$idTrack;
        $urlTrackLyrics .= '&apikey='.$apikey;
        $urlTrackLyrics .= '&format=xml';
        /*End URL creation*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlTrackLyrics);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);   
        curl_close($ch);
        $xml = simplexml_load_string($response);
        return $xml->body->lyrics->lyrics_body;
    }
}    
?>