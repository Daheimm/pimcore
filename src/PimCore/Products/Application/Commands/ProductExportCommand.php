<?php

namespace App\PimCore\Products\Application\Commands;


use App\PimCore\Products\Application\Messages\Exports\ProductExportsMessage;
use App\PimCore\Products\Application\Services\Interfaces\ProductsInformation\ProductInfoProcessorServiceInterface;
use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\Product;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:product-export',
    description: 'Product export'
)]
class ProductExportCommand extends AbstractCommand
{
    public function __construct(
        private readonly ProductInfoProcessorServiceInterface $infoProcessorService,
        private readonly MessageBusInterface                  $bus)
    {
        parent::__construct();
    }

    private function jsonEncode($v)
    {
        return json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $batchSize = 40;
        $offset = 0;
        $products = Product::getList();
        try {
            while (true) {
                $batchItems = $products?->getItems($offset, $batchSize);

                if (count($batchItems) === 0) {
                    break;
                }



                $productsPrepared = $this->infoProcessorService->extract($batchItems);

                $this->bus->dispatch(new ProductExportsMessage($productsPrepared), [
                    new AmqpStamp(ProductExportsMessage::ROUTING_KEY),
                ]);
                $offset += $batchSize;
            }
        } catch (\Exception $e) {
            dd($e);
        }

        return Command::SUCCESS;
    }
}
