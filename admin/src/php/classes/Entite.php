<?php
abstract class Entite
{
    protected array $_attributs = [];

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $champ => $valeur) {
            $this->__set($champ, $valeur);
        }
    }

    public function __get(string $champ)
    {
        return $this->_attributs[$champ] ?? null;
    }

    public function __set(string $champ, $valeur): void
    {
        $this->_attributs[$champ] = $valeur;
    }

    public function toArray(): array
    {
        return $this->_attributs;
    }
}
