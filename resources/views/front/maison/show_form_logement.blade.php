@extends('layouts.front_app')
@section('content')

<form action="{{ route('maison.search.logement') }}" method="post" class="search-form">
    @csrf
    <div class="table-container">
        <table>
            <tbody>
                <tr>
                    <td class="label">Commune</td>
                    <td>
                        <select name="commune_id" id="commune"  required>
                            @foreach($communes as $commune)
                            <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">Studio</td>
                    <td>
                        <input type="checkbox" name="is_Studio" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Chambre</td>
                    <td>
                        <input type="checkbox" name="is_Chambre" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Residence</td>
                    <td>
                        <input type="checkbox" name="is_Residence" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Appartement</td>
                    <td>
                        <input type="checkbox" name="is_Appartment" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Maison basse</td>
                    <td>
                        <input id="maisonbasse" onclick="showCommodities()" type="checkbox" name="is_MAISON_BASSE" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Duplexe</td>
                    <td>
                        <input type="checkbox" name="is_DUPLEX" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Habitat haut standing</td>
                </tr>
                <td>
                    <label>Avec piscine</label>
                    <input type="radio" name="has_PISCINE" value="1" class="radio">
                </td>
                <td>
                    <label>Sans piscine</label>
                    <input type="radio" name="has_PISCINE" value="0" class="radio">
                </td>
                <tr>
                    <td class="label">Nombre de pieces</td>
                    <td>
                        <input type="number" name="nombre_piece"  min="1" max="10" required>
                    </td>
                </tr>
                <tr>
                    <td class="label">Nombre de salle d'eau</td>
                    <td>
                        <input type="number" name="nombre_salle_eau"  min="1" max="5" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">Commodités additionnelles</td>
                </tr>
                <tr>
                    <td class="label">Cour avant</td>
                    <td>
                        <input type="checkbox" name="has_COUR_AVANT" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Cour arriere</td>
                    <td>
                        <input type="checkbox" name="has_COUR_ARRIERE" class="checkbox">
                    </td>
                </tr>
                <tr id="" style="display:none;">
                    <td class="label">Balcon avant</td>
                    <td>
                        <input type="checkbox" name="has_balcon_avant" class="checkbox">
                    </td>
                </tr>
                <tr id="" style="display:none;">
                    <td class="label">Balcon arriere</td>
                    <td>
                        <input type="checkbox" name="has_balcon_arriere" class="checkbox">
                    </td>
                </tr>
                <tr>
                    <td class="label">Sécurité</td>
                    <td>
                        Avec gardien<input type="radio" name="has_GARDIEN" value="1" class="radio">
                        Sans gardien<input type="radio" name="has_GARDIEN" value="0" class="radio">
                    </td>
                </tr>
                <tr>
                    <td class="label">Garage</td>
                    <td>
                        Avec garage<input type="radio" name="has_GARAGE" value="1" class="radio">
                        Sans garage<input type="radio" name="has_GARAGE" value="0" class="radio">
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
            <button type="submit" class="btn btn-warning">RECHERCHER </button>
        </center>
    </div>
</form>

@endsection