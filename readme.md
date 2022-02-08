# Alura Arquitetura
Projeto criado no treinamento [PHP e Clean Architecture: Descomplicando arquitetura de software](https://cursos.alura.com.br/course/php-introducao-clean-achitecture "PHP e Clean Architecture: Descomplicando arquitetura de software").

Publicado aqui apenas para referência futura.

## Alterações feitas:
- Foi criado o módulo `Shared` para as classes compartilhadas.
- Ao invés de adicionar os módulos dentro de cada camada de Clean Architecture, os módulos propriamente ditos foram estruturados em camadas.  Na prática não vejo muita diferença entre uma e outra forma. No caso desta estruturação, ela me permite reutilizar os módulos em outros projetos facilmente, que no meu caso é um fator importante.
- A interface `SendReferralEmail` foi adicionada ao Domain do módulo `Referral`. Se há um módulo responsável pelas indicações, não vejo motivo para que o domínio de `Studends` conheça ele.