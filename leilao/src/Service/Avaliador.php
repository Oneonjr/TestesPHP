<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Lance;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;//Melhoria avaliador

    public function avalia(Leilao $leilao): void
    {
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }

            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }

        $lances = $leilao->getLances();//Melhoria avaliador
        usort($lances, function (Lance $lance1, Lance $lance2) {//Melhoria avaliador
            return $lance2->getValor() - $lance1->getValor();
        });
        $this->maioresLances = array_slice($lances, 0, 3);
    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    /**
    * @return Lance[]
    */
    public function getMaioresLances(): array//Melhoria avaliador
    {
    return $this->maioresLances;
    }
}
