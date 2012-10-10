<?php
// $Id$

/**
 * Add site specific files.
 *
 * @param $install_state
 *   An array of information about the current installation state.
 */
function ombuprofile_add_files($install_state) {
  // @todo: need to change this to use D7 api.
  $path = 'sites/default/files/';

  $files = array(

    //         array( // fid 1
    //             'source' => $path.'news/n17.jpg',
    //             'mime' => 'image/jpeg',
    //         ),

  );

  // Since these files are already in the correct dir, we'll just write to the db

  foreach( $files as $file ) {

    $f = new stdClass();
    $f->filename = basename($file['source']);
    $f->filepath = $file['source'];
    $f->filemime = $file['mime'];
    $f->filesize = filesize($file['source']);
    $f->uid = 1;
    $f->status = 0;
    $f->timestamp = time();
    drupal_write_record('files', $f);

  }
}
