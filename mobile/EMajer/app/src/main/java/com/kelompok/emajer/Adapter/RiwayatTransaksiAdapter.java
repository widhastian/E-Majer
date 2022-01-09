package com.kelompok.emajer.Adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.kelompok.emajer.API.APIRequestRiwayatTransaksi;
import com.kelompok.emajer.API.APIUtils;
import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatAll;
import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatDetail;
import com.kelompok.emajer.Activity.Transaksi.RiwayatTransaksi.PaymentActivity;
import com.kelompok.emajer.R;

import java.text.DateFormat;
import java.text.NumberFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class RiwayatTransaksiAdapter extends RecyclerView.Adapter<RiwayatTransaksiAdapter.RiwayatViewHolder> {

    APIRequestRiwayatTransaksi apiRequestRiwayatTransaksi;
    Context context;
    List<RiwayatAll> riwayatAll;
    List<RiwayatDetail> riwayatDetail = new ArrayList<>();
    CheckBox[] ch;

    public RiwayatTransaksiAdapter(Context context, List<RiwayatAll> riwayatAll){
        this.context = context;
        this.riwayatAll = riwayatAll;
    }

    @NonNull
    @Override
    public RiwayatViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.row_list_riwayat_transaksi, parent, false);
        apiRequestRiwayatTransaksi = APIUtils.getReqRiwayatTransaksi();
        return new RiwayatViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull RiwayatViewHolder holder, @SuppressLint("RecyclerView") int position ) {
        riwayatDetail = riwayatAll.get(position).getRiwayatDetail();

        List<RiwayatDetail> dList = riwayatDetail;

        ch = new CheckBox[dList.size()];
        for(int i=0; i<dList.size(); i++) {
            ch[i] = new CheckBox(context);
            String keterangan = dList.get(i).getKeterangan();
            Integer nominal = dList.get(i).getNominal();
            ch[i].setText(keterangan + " | "+formatRupiah(Double.parseDouble(nominal.toString())) );
            ch[i].setTextColor(Color.parseColor("#000000"));
            ch[i].setEnabled(false);
            ch[i].setChecked(true);
            ch[i].setButtonDrawable(0);
            holder.rtLinearLayout.addView(ch[i]);
        }

        String status = riwayatAll.get(position).getStatus();
        holder.tvStatus.setText(status);
        holder.tvTotal.setText(formatRupiah(Double.parseDouble(riwayatAll.get(position).getTotal().toString())));
        String tglLama=riwayatAll.get(position).getTanggal_bayar();
        DateFormat dateFormat = new SimpleDateFormat("dd MMM yyyy");
        DateFormat df=new SimpleDateFormat("yyyy-MM-dd");
        try {
            String tglBaru=dateFormat.format(df.parse(tglLama));
            holder.tvTanggal.setText(tglBaru+" ");
        } catch (ParseException e) {
            e.printStackTrace();
        }

        String bayar = "sudah bayar";
        if (status.equals(bayar)){
            holder.tvStatus.setTextColor(Color.parseColor("#0B9933"));
        }

        String veirifikasi = "veirifikasi";
        if (status.equals(veirifikasi)){
            holder.tvStatus.setTextColor(Color.parseColor("#0D08F4"));
        }

        String belum = "belum bayar";
        if (status.equals(belum)){
            holder.btnBayar.setVisibility(View.VISIBLE);
            holder.btnBayar.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent i = new Intent(context, PaymentActivity.class);
                    i.putExtra("id_transaksi", riwayatAll.get(position).getId_transaksi());
                    i.putExtra("total", riwayatAll.get(position).getTotal());
                    context.startActivity(i);
                }
            });
        }

    }

    @Override
    public int getItemCount() {
        return riwayatAll.size();
    }

    public class RiwayatViewHolder extends RecyclerView.ViewHolder {
        Button btnBayar;
        TextView tvTanggal, tvStatus, tvTotal;
        LinearLayout rtLinearLayout;

        public RiwayatViewHolder(@NonNull View itemView) {
            super(itemView);
            btnBayar = itemView.findViewById(R.id.rt_btnBayar);
            tvTanggal = itemView.findViewById(R.id.rt_tanggal);
            tvStatus = itemView.findViewById(R.id.rt_status);
            tvTotal = itemView.findViewById(R.id.rt_total);
            rtLinearLayout = itemView.findViewById(R.id.rt_linearlayout);
        }
    }

    private String formatRupiah(Double number){
        Locale localeID = new Locale("in", "ID");
        NumberFormat formatRupiah = NumberFormat.getCurrencyInstance(localeID);
        return formatRupiah.format(number);
    }

}
