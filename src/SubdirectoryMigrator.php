<?php

namespace Misakstvanu\SubdirectoryMigrations;

use Illuminate\Database\Migrations\Migrator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SubdirectoryMigrator extends Migrator
{
    /**
     * Get all of the migration files in a given path, including subdirectories.
     *
     * @param  string|array  $paths
     * @return array
     */
    public function getMigrationFiles($paths)
    {
        $expandedPaths = [];

        foreach ((array) $paths as $path) {
            $expandedPaths[] = $path;

            if (! is_dir($path)) {
                continue;
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $file) {
                if ($file->isDir()) {
                    $expandedPaths[] = $file->getPathname();
                }
            }
        }

        return parent::getMigrationFiles(array_unique($expandedPaths));
    }
}
