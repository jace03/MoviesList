<?php

namespace App\Console\Commands;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Illuminate\Console\Command;

class DropDatabaseSchema extends Command
{
    protected $signature = 'doctrine:schema:drop';
    protected $description = 'Drop database schema';

    public function handle(EntityManagerInterface $entityManager)
    {
        $schemaTool = new SchemaTool($entityManager);
        $classes = $entityManager->getMetadataFactory()->getAllMetadata();

        try {
            $schemaTool->dropSchema($classes);
            $this->info('Schema dropped successfully!');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
