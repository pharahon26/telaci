<style>
 
</style>

@extends('layouts.front_app')
@section('content')
    <form action="{{ route('maison.search.bureau') }}" method="post" class="search-form">
        @csrf
        <div class="table-container">
            <table>
                <tbody>
                    <!-- Commune -->
                    <tr>
                        <td class="label">Commune</td>
                        <td>
                            <select name="commune_id" id="commune" required>
                                @foreach ($communes as $commune)
                                    <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Type de logement -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <h4>Type de logement</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Studio</td>
                        <td><input type="checkbox" name="is_Studio" class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Chambre</td>
                        <td><input type="checkbox" name="is_Chambre" class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Residence</td>
                        <td><input type="checkbox" name="is_Residence" class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Appartement</td>
                        <td><input type="checkbox" name="is_Appartment" class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Maison basse</td>
                        <td><input id="maisonbasse" onclick="showCommodities()" type="checkbox" name="is_MAISON_BASSE"
                                class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Duplexe</td>
                        <td><input type="checkbox" name="is_DUPLEX" class="checkbox"></td>
                    </tr>
                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Habitat haut standing -->
                    <tr>
                        <td class="label">Habitat haut standing</td>
                    </tr>

                    <tr>
                        <td>
                            <label>Avec piscine</label>
                            <input type="radio" name="has_PISCINE" value="1" class="radio">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sans piscine</label>
                            <input type="radio" name="has_PISCINE" value="0" class="radio">
                        </td>
                    </tr>

                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Nombre de pièces et salle d'eau -->
                    <tr>
                        <td class="label">Nombre de pièces</td>
                        <td><input type="number" name="nombre_piece" min="1" max="10" required></td>
                    </tr>
                    <tr>
                        <td class="label">Nombre de salle d'eau</td>
                        <td><input type="number" name="nombre_salle_eau" min="1" max="5" required></td>
                    </tr>
                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Commodités additionnelles -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <h4>Commodités additionnelles</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Cour avant</td>
                        <td><input type="checkbox" name="has_COUR_AVANT" class="checkbox"></td>
                    </tr>
                    <tr>
                        <td class="label">Cour arrière</td>
                        <td><input type="checkbox" name="has_COUR_ARRIERE" class="checkbox"></td>
                    </tr>
                    <tr id="balconAvant" style="display:none;">
                        <td class="label">Balcon avant</td>
                        <td><input type="checkbox" name="has_balcon_avant" class="checkbox"></td>
                    </tr>
                    <tr id="balconArriere" style="display:none;">
                        <td class="label">Balcon arriere</td>
                        <td><input type="checkbox" name="has_balcon_arriere" class="checkbox"></td>
                    </tr>
                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Sécurité -->
                    <tr>
                        <td class="label">Sécurité</td>
                    </tr>

                    <tr>
                        <td>
                            <label>Avec gardien</label>
                            <input type="radio" name="has_GARDIEN" value="1" class="radio">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sans gardien</label>
                            <input type="radio" name="has_GARDIEN" value="0" class="radio">

                        </td>
                    </tr>
                    <tr class="section-divider">
                        <td colspan="2"></td>
                    </tr>
                    <!-- Garage -->
                    <tr>
                        <td class="label">Garage</td>
                    </tr>

                    <tr>
                        <td>
                            <label>Avec garage</label>
                            <input type="radio" name="has_GARAGE" value="1" class="radio">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sans garage</label> <input type="radio" name="has_GARAGE" value="0"
                                class="radio">

                        </td>
                    </tr>

                </tbody>
            </table>
            <center>
                <button type="submit" class="table-button">RECHERCHER</button>
            </center>
        </div>
    </form>
@endsection