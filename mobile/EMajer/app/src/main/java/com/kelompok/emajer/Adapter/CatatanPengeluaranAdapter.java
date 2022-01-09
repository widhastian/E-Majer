package com.kelompok.emajer.Adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok.emajer.API.APIRequestCatatanPengeluaran;
import com.kelompok.emajer.API.RetrofitClient;
import com.kelompok.emajer.Activity.Transaksi.CatatanPengeluaran.CatatanPengeluaranDetail;
import com.kelompok.emajer.Model.CatatanPengeluaran.DataPengeluaran;
import com.kelompok.emajer.Model.CatatanPengeluaran.DataPengeluaranResponse;
import com.kelompok.emajer.R;

import java.text.NumberFormat;
import java.util.List;
import java.util.Locale;
import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CatatanPengeluaranAdapter extends RecyclerView.Adapter<CatatanPengeluaranAdapter.CatatanViewHolder> {
    Context context;
    List<DataPengeluaran> listData;
    List<DataPengeluaran> listPengeluaran = new ArrayList<>();
    private String id_pengeluaran;

    public CatatanPengeluaranAdapter(Context context, List<DataPengeluaran> listData){
        this.context = context;
        this.listData = listData;
    }

    @NonNull
    @Override
    public CatatanViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.row_list_cttpengeluaran, parent, false);
        CatatanViewHolder holder = new CatatanViewHolder(layout);
        return holder;

    }

    @Override
    public void onBindViewHolder(@NonNull CatatanViewHolder holder, int position) {
        DataPengeluaran dm = listData.get(position);

        holder.cttid_pengeluaran.setText(dm.getId_pengeluaran());
        holder.cttTanggal.setText(dm.getTgl_pengeluaran());
        holder.cttTotalPengeluaran.setText("- "+formatRupiah(Double.parseDouble(dm.getNominal_pengeluaran())));
    }

    @Override
    public int getItemCount() {
        return listData.size();
    }

    public class CatatanViewHolder extends RecyclerView.ViewHolder {
        TextView cttid_pengeluaran,cttTanggal, cttTotalPengeluaran;
        public CatatanViewHolder(@NonNull View itemView) {
            super(itemView);
            cttid_pengeluaran = itemView.findViewById(R.id.ctt_idpengeluaran);
            cttTanggal = itemView.findViewById(R.id.ctt_tanggal);
            cttTotalPengeluaran = itemView.findViewById(R.id.ctt_totalPengeluaran);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    id_pengeluaran = cttid_pengeluaran.getText().toString();
                    buildDataPengeluaran();
                }
            });
        }
    }

    private void buildDataPengeluaran(){
        APIRequestCatatanPengeluaran ardData = RetrofitClient.getClient1().create(APIRequestCatatanPengeluaran.class);
        Call<DataPengeluaranResponse> ambilData = ardData.ambilPengeluaran(id_pengeluaran);
        ambilData.enqueue(new Callback<DataPengeluaranResponse>() {
            @Override
            public void onResponse(Call<DataPengeluaranResponse> call, Response<DataPengeluaranResponse> response) {
                int kode = response.body().getKode();
                String pesan = response.body().getPesan();
                listPengeluaran = response.body().getData();

                String varIdPengeluaran = listPengeluaran.get(0).getId_pengeluaran();
                String varNamaAkun = listPengeluaran.get(0).getNama();
                String varNominalPengeluaran = listPengeluaran.get(0).getNominal_pengeluaran();
                String varTanggalPengeluaran = listPengeluaran.get(0).getTgl_pengeluaran();
                String varFotoNota = listPengeluaran.get(0).getFoto();

                Intent kirim = new Intent(context, CatatanPengeluaranDetail.class);
                kirim.putExtra("id_pengeluaran", varIdPengeluaran);
                kirim.putExtra("nama_akun", varNamaAkun);
                kirim.putExtra("totalPengeluaran", varNominalPengeluaran);
                kirim.putExtra("tanggal", varTanggalPengeluaran);
                kirim.putExtra("foto", varFotoNota);
                context.startActivity(kirim);

//                    Toast.makeText(getBaseContext(), "Pesan: "+ msg+" | Saldo: "+saldoKelas, Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(Call<DataPengeluaranResponse> call, Throwable t) {
                Toast.makeText(context, "Gagal konek server: "+ t.getLocalizedMessage(), Toast.LENGTH_SHORT).show();
            }
        });

    }


    private String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }

}
