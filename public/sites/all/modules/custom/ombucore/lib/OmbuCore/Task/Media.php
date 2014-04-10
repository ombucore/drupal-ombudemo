<?php
/**
 * @file
 * Setup media related configuration.
 */

namespace OmbuCore\Task;

class Media extends Task {
  /**
   * Setup oembed related integration into files_entity.
   */
  public function process() {
    // Add oembed streams to video file types.
    $video = file_type_load('video');
    $video->mimetypes[] = 'video/oembed';
    $video->streams[] = 'oembed';
    file_type_save($video);

    // Oembed specific display settings for videos.
    $file_display = new \stdClass();
    $file_display->api_version = 1;
    $file_display->name = 'video__default__oembed';
    $file_display->weight = -10;
    $file_display->status = TRUE;
    $file_display->settings = array(
      'width' => '560',
      'height' => '340',
      'wmode' => '',
    );
    file_display_save($file_display);

    $file_display = new \stdClass();
    $file_display->api_version = 1;
    $file_display->name = 'video__default__oembed_thumbnail';
    $file_display->weight = -10;
    $file_display->status = TRUE;
    $file_display->settings = array(
      'width' => '180',
      'height' => '',
    );
    file_display_save($file_display);

    $file_display = new \stdClass();
    $file_display->api_version = 1;
    $file_display->name = 'video__preview__oembed_thumbnail';
    $file_display->weight = -10;
    $file_display->status = TRUE;
    $file_display->settings = array(
      'width' => '100',
      'height' => '75',
    );
    file_display_save($file_display);

    $file_display = new \stdClass();
    $file_display->api_version = 1;
    $file_display->name = 'video__teaser__oembed_thumbnail';
    $file_display->weight = -10;
    $file_display->status = TRUE;
    $file_display->settings = array(
      'width' => '100',
      'height' => '75',
    );
    file_display_save($file_display);

  }
}
